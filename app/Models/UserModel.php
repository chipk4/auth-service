<?php

namespace App\Models;

use App\Contracts\UserContract;
use Carbon\Carbon;
use Illuminate\Support\Arr;

/**
 * Class UserModel
 * @package App\Models
 */
class UserModel implements UserContract, \JsonSerializable
{
    /**
     * @var string
     */
    private $nickName;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var int
     */
    private $age;

    /**
     * @var string
     */
    private $password;

    /**
     * @var Carbon
     */
    private $createdAt;

    /**
     * @var Carbon
     */
    private $updatedAt;

    /**
     * UserModel constructor.
     * @param array $userData
     * @throws \Exception
     *
     * Map user data from array to object properties
     */
    public function __construct(array $userData = [])
    {
        if ($userData) {
            foreach ($userData as $key => $val) {
                if(!property_exists($this, $key)) {
                    throw new \Exception("Property $key doesn't exist");
                }
                $this->{$key} = $val;
            }
        }
    }

    /**
     * @return string
     */
    public function getNickName(): string
    {
        return $this->nickName;
    }

    /**
     * @return string
     */
    public function getFirsName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return md5($this->getNickName());
    }

    /**
     * @return string
     */
    public function getAuthIdentifier(): string
    {
        return $this->getId();
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
