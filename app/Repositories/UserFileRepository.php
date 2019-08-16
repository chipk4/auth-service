<?php

namespace App\Repositories;

use App\Contracts\UserContract;
use App\Models\UserModel;
use League\Flysystem\FileNotFoundException;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserFileRepository implements UserRepositoryInterface
{
    //here we may switch repository
    protected $repository;

    const USER_FOLDER      = 'profiles' . DIRECTORY_SEPARATOR;
    //of course, I can use memcache or redis for this purpose, but let's stay only in file system for this test task
    const USER_CREDENTIALS = 'creds' . DIRECTORY_SEPARATOR . 'user_keys';

    public function __construct()
    {
        $this->repository = app('filesystem');
    }

    /**
     * @param string $nickName
     * @return UserContract
     *
     * @throws FileNotFoundException
     */
    public function getProfileByNickName(string $nickName): UserContract
    {
        $data = $this->repository->get(self::USER_FOLDER . md5($nickName));
        return new UserModel(json_decode($data, true));

    }

    /**
     * @param UserContract $user
     */
    public function saveProfile(UserContract $user): void
    {
        $this->repository->put(self::USER_FOLDER . md5($user->getNickName()), json_encode($user));
    }

    /**
     * @param string $nickName
     * @return UserContract|null
     */
    public function searchProfileByNickname(string $nickName): ?UserContract
    {
        $path = self::USER_FOLDER . md5($nickName);
        if ($this->repository->exists($path)) {
            $data = $this->repository->get($path);
            return new UserModel(json_decode($data, true));
        }

        return null;
    }

    public function checkCredentials(string $apiKey)
    {

    }

    public function attachApiKey(string $nickName, string $apiKey)
    {

    }
}
