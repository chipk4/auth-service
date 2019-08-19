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
            'data.attributes.firstName' => 'required',
            'data.attributes.lastName'  => 'required',
            'data.attributes.nickName'  => 'required',
            'data.attributes.age'        => 'required|numeric',
            'data.attributes.password'   => 'required|min:6'
        ]);
    }

    /**
     * @param array $additionalRules
     * @return array
     */
    public function getUserAuthRules(array $additionalRules = [])
    {
        return array_merge($additionalRules, [
            'data.attributes.nickName' => 'required',
            'data.attributes.password' => 'required|min:6'
        ]);
    }
}
