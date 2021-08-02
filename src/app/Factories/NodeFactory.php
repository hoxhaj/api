<?php

namespace Api\Factories;

use Api\Models\Node;

class NodeFactory
{
    /**
     * @param mixed ...$args
     * @return Node
     */
    public static function build(...$args)
    {
        [$node] = $args;

        return new Node(
            (int) $node->idNode,
            $node->nodeName,
            (int) $node->nodes
        );
    }
}