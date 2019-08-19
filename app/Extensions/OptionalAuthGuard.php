<?php

namespace App\Extensions;

use Illuminate\Auth\GenericUser;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

/**
 * Class OptionalAuthGuard
 * @package App\Extensions
 */
class OptionalAuthGuard implements Guard
{
    use GuardHelpers;

    private $request;
    private $inputKey;
    private $storageKey;

    /**
     * OptionalAuthGuard constructor.
     * @param UserProvider $provider
     * @param Request $request
     * @param $configuration
     */
    public function __construct(UserProvider $provider, Request $request, $configuration)
    {
        $this->provider = $provider;
        $this->request = $request;
        $this->inputKey = isset($configuration['input_key']) ? $configuration['input_key'] : 'access_token';
        $this->storageKey = isset($configuration['storage_key']) ? $configuration['storage_key'] : 'access_token';
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        if (!is_null($this->user)) {
            return $this->user;
        }

        $user = null;

        // retrieve via token
        $token = $this->getTokenForRequest();

        if (!empty($token)) {
            // the token was found, how you want to pass?
            $user = $this->provider->retrieveByToken($this->storageKey, $token);

        } else {
            $user = new GenericUser([
                'id' => $this->request->session()->getId()
            ]);
        }

        return $this->user = $user;
    }

    /**
     * Get the token for the current request.
     * @return string
     */
    public function getTokenForRequest()
    {
        $token = $this->request->query($this->inputKey);

        if (empty($token)) {
            $token = $this->request->input($this->inputKey);
        }

        if (empty($token)) {
            $token = $this->request->bearerToken();
        }

        return $token;
    }

    /**
     * Validate a user's credentials.
     *
     * @param array $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        // TODO: Implement validate() method.
    }
}
