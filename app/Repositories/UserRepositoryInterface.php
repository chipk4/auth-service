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
    public function getProfileByNickName(string $nickName): UserContract;

    /**
     * @param UserContract $user
     */
    public function saveProfile(UserContract $user): void;

    /**
     * @param string $nickName
     * @return UserContract|null
     */
    public function searchProfileByNickname(string $nickName): ?UserContract;
}
