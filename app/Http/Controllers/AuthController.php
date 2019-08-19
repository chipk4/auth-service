<?php

namespace App\Http\Controllers;

use App\Contracts\UserContract;
use App\Http\Response\Schemas\Api\User\AuthSchema;
use App\Http\Response\Schemas\Api\User\ProfileSchema;
use App\Http\Validators\AuthValidator;
use App\Models\UserModel;
use App\Repositories\UserFileRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Neomerx\JsonApi\Contracts\Factories\FactoryInterface;
use Neomerx\JsonApi\Encoder\Encoder;
use Ramsey\Uuid\Uuid;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends BaseController
{
    protected $validationRules;
    protected $repository;
    protected $cache;

    public function __construct()
    {
        $this->validationRules = new AuthValidator();
        $this->repository = new UserFileRepository();
        $this->cache = app('redis');
    }

    /**
     * @param Request $request
     * @return bool
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        //create custom rule for check if user exist
        $userValidatedData = $this->validate($request, $this->validationRules->getUserRegisterRules());

        $userNickName = Arr::get($userValidatedData, 'data.attributes.nickName');
        $userPassword = Arr::get($userValidatedData, 'data.attributes.password');
        Arr::set($userValidatedData, 'data.attributes.password', Hash::make($userPassword));
        $user = $this->repository->searchProfileByNickname($userNickName);
        if (!$user instanceof UserContract) {
            $user = new UserModel($userValidatedData['data']['attributes']);
        }

        $encoder = Encoder::instance([
            UserModel::class => ProfileSchema::class,
        ])->withEncodeOptions(JSON_PRETTY_PRINT);

        $this->repository->saveProfile($user);

        return $encoder->encodeData($user);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $userValidatedData = $this->validate($request, $this->validationRules->getUserAuthRules());
        $userNickName = Arr::get($userValidatedData, 'data.attributes.nickName');
        $userPassword = Arr::get($userValidatedData, 'data.attributes.password');
        $user = $this->repository->searchProfileById(md5($userNickName));

        // do not use text here, need to create cache
        if ($user && Hash::check($userPassword, $user->getPassword())) {
            $apiKey = base64_encode((Uuid::uuid1())->toString());
            $this->repository->attachApiKey($user->getNickName(), $apiKey);
            $this->cache->hmset('users:profiles:'.$apiKey, [
                'id' => md5($user->getNickName())
            ]);

            $authSchema = function (FactoryInterface $factory) use ($apiKey) {
                return new AuthSchema($factory, $apiKey);
            };

            $encoder = Encoder::instance([
                UserModel::class => $authSchema,
            ])->withEncodeOptions(JSON_PRETTY_PRINT);

            return $encoder->encodeData($user);
        }

        return response()->json([], 404);
    }
}
