<?php

namespace App\Http\Controllers;

use App\Contracts\UserContract;
use App\Http\Validators\AuthValidator;
use App\Models\UserModel;
use App\Repositories\UserFileRepository;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends BaseController
{
    protected $validationRules;
    protected $repository;

    public function __construct()
    {
        $this->validationRules = new AuthValidator();
        $this->repository = new UserFileRepository();
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

        $nickname = $request->input('nickName');
        $user = $this->repository->searchProfileByNickname($nickname);
        $userValidatedData['password'] = Hash::make($userValidatedData['password']);
        if (!$user instanceof UserContract) {
            $user = new UserModel($userValidatedData);
        }

        $this->repository->saveProfile($user);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $userValidatedData = $this->validate($request, $this->validationRules->getUserAuthRules());
        $user = $this->repository->searchProfileByNickname($userValidatedData['nickName']);
        if (Hash::check($userValidatedData['password'], $user->getPassword())) {
            $apiKey = base64_encode(str_random(40));
            $this->repository->attachApiKey($user->getNickName(), $apiKey);
            return response()->json(['status' => 'success','api_key' => $apiKey]);
        }

        return response()->json(['status' => 'false']);
    }
}
