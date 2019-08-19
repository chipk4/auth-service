<?php

namespace App\Http\Response\Schemas\Api\User;

use App\Contracts\UserContract;
use Neomerx\JsonApi\Schema\BaseSchema;

/**
 * Class ProfileSchema
 * @package App\Http\Response\Schemas\Api\User
 */
class ProfileSchema extends BaseSchema
{
    /**
     * Get resource type.
     *
     * @return string
     */
    public function getType(): string
    {
        return "user";
    }

    /**
     * Get resource identity. Newly created objects without ID may return `null` to exclude it from encoder output.
     *
     * @param UserContract $resource
     *
     * @return string|null
     */
    public function getId($resource): ?string
    {
        return $resource->getId();
    }

    /**
     * Get resource attributes.
     *
     * @param UserContract $resource
     *
     * @return iterable
     */
    public function getAttributes($resource): iterable
    {
        return [
            "first_name" => $resource->getFirsName(),
            "last_name"  => $resource->getLastName(),
            "nick_name"  => $resource->getNickName(),
            "age"        => $resource->getAge()
        ];
    }

    /**
     * Get resource relationship descriptions.
     *
     * @param mixed $resource
     *
     * @return iterable
     */
    public function getRelationships($resource): iterable
    {
        return [];
    }
}
