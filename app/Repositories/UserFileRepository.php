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
    public function getByNickName(string $nickName): UserContract
    {
        $data = $this->repository->get(md5($nickName));
        return new UserModel(json_decode($data, true));

    }

    /**
     * @param UserContract $user
     */
    public function save(UserContract $user): void
    {
        $this->repository->put(md5($user->getNickName()), json_encode($user));
    }

    /**
     * @param string $nickName
     * @return UserContract|null
     */
    public function searchByNickname(string $nickName): ?UserContract
    {
        if ($this->repository->exists(md5($nickName))) {
            $data = $this->repository->get(md5($nickName));
            return new UserModel(json_decode($data, true));
        }

        return null;
    }
}
