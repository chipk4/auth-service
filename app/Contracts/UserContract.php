<?php

namespace App\Contracts;

/**
 * Interface UserContract
 * @package App\Contracts
 */
interface UserContract
{
    /**
     * @return string
     */
    public function getId(): string;

    /**
     * @return string
     */
    public function getNickName(): string;

    /**
     * @return string
     */
    public function getFirsName(): string;

    /**
     * @return string
     */
    public function getLastName(): string;

    /**
     * @return int
     */
    public function getAge(): int;

    /**
     * @return string
     */
    public function getPassword(): string;
}
