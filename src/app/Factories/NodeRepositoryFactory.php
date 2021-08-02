<?php

namespace Api\Factories;

use Api\Database\DatabaseConnector;
use Api\Repositories\NodeRepository;

class NodeRepositoryFactory implements FactoryInterface
{
    /**
     * @param mixed ...$args
     * @return NodeRepository
     */
    public static function build(...$args)
    {
        return new NodeRepository(
            new DatabaseConnector()
        );
    }
}