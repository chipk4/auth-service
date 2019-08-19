<?php namespace App\Extensions;

use App\Models\UserModel;
use App\Repositories\UserFileRepository;
use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

/**
 * Class TokenToUserProvider
 * @package App\Extensions
 */
class TokenToUserProvider implements UserProvider
{
    private $user;
    private $userRepository;
    private $cacheService;

    public function __construct(UserModel $user)
    {
        $this->user = $user;
        $this->userRepository = new UserFileRepository();
        $this->cacheService = app('redis');
    }

    public function retrieveById($identifier)
    {
        //implement return by id
    }

    public function retrieveByToken($identifier, $token)
    {
        $user = $this->cacheService->hmget('users:profiles:' . $token, ['id']);
        $userId = array_shift($user);
        $user = $this->userRepository->searchProfileById($userId);

        return $token && $user ? $user : null;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // update via remember token not necessary
    }

    public function retrieveByCredentials(array $credentials)
    {
        // need to implement
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $plain = $credentials['password'];

        return app('hash')->check($plain, $user->getAuthPassword());
    }
}
