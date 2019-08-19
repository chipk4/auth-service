<?php

namespace App\Http\Response\Schemas\Api\User;

use App\Contracts\UserContract;
use Neomerx\JsonApi\Contracts\Factories\FactoryInterface;
use Neomerx\JsonApi\Schema\BaseSchema;

/**
 * Class ProfileSchema
 * @package App\Http\Response\Schemas\Api\User
 */
class AuthSchema extends ProfileSchema
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * CitationSchema constructor.
     *
     * @param FactoryInterface $factory
     * @param string $apiKey
     */
    public function __construct(FactoryInterface $factory, string $apiKey)
    {
        parent::__construct($factory);

        $this->apiKey = $apiKey;
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
        return array_merge(parent::getAttributes($resource), [
            'api_key' => $this->apiKey
        ]);
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
