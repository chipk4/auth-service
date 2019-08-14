<?php

namespace App\Http\Controllers;

use App\Contracts\UserContract;
use App\Http\Validators\AuthValidator;
use App\Models\UserModel;
use App\Repositories\UserFileRepository;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends BaseController
{
    protected $registerValidationRule;
    protected $repository;

    public function __construct()
    {
        $this->registerValidationRule = (new AuthValidator())->getUserRegisterRules();
        //use dependency injection in AppServiceProvider
        $this->repository = new UserFileRepository();// User Repository
    }

    /**
     * @param Request $request
     * @return bool
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        //create custom rule for check if user exist
        $userValidatedData = $this->validate($request, $this->registerValidationRule);

        $nickname = $request->input('nickName');
        $user = $this->repository->searchByNickname($nickname);

        if (!$user instanceof UserContract) {
            $user = new UserModel($userValidatedData);
        }

        $this->repository->save($user);
    }

    public function login(Request $request)
    {

    }
}
