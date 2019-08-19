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
    const USER_FOLDER = 'profiles' . DIRECTORY_SEPARATOR;

    public function __construct()
    {
        $this->repository = app('filesystem');
    }

    /**
     * @param string $nickName
     * @return UserContract
     *
     * @throws FileNotFoundException
     * @throws \Exception
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
     * @throws \Exception
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

    /**
     * Id it's a md5 of user nickName
     *
     * @param string $id
     * @return UserContract|null
     * @throws \Exception
     */
    public function searchProfileById(string $id): ?UserContract
    {
        $path = self::USER_FOLDER . $id;
        if ($this->repository->exists($path)) {
            $data = $this->repository->get($path);

            return new UserModel(json_decode($data, true));
        }

        return null;
    }

    public function attachApiKey(string $nickName, string $apiKey)
    {
        //TODO:: need to attach api key to user file profile.
        //it needs for redis clean
    }
}
