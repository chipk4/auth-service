<?php

namespace App\Http\Validators;

/**
 * Class AuthValidator
 * @package App\Http\Validators
 *
 * This class represent all rules that can be used for user authorisation
 */
class AuthValidator
{
    /**
     * @param array $additionalRules
     * @return array
     */
    public function getUserRegisterRules(array $additionalRules = [])
    {
        return array_merge($additionalRules, [
            'firstName' => 'required',
            'lastName'  => 'required',
            'nickName'  => 'required',
            'age'        => 'required|numeric',
            'password'   => 'required|min:6'
        ]);
    }

    /**
     * @param array $additionalRules
     * @return array
     */
    public function getUserAuthRules(array $additionalRules = [])
    {
        return array_merge($additionalRules, [
            'nickName' => 'required',
            'password' => 'required|min:6'
        ]);
    }
}
