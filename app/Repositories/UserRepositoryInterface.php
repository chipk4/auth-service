<?php

namespace App\Repositories;

use App\Contracts\UserContract;

/**
 * Interface RepositoryInterface
 * @package App\Repositories
 */
interface UserRepositoryInterface
{
    /**
     * @param string $nickName
     * @return UserContract
     */
    public function getByNickName(string $nickName): UserContract;

    /**
     * @param UserContract $user
     */
    public function save(UserContract $user): void;

    /**
     * @param string $nickName
     * @return UserContract|null
     */
    public function searchByNickname(string $nickName): ?UserContract;
}
