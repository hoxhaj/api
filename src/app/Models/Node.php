<?php

namespace Api\Models;

class Node extends Model
{
    /**
     * @var int
     */
    public $node_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $children_count;


    /**
     * Node constructor.
     * @param int $node_id
     * @param string $name
     * @param int $children_count
     */
    public function __construct(int $node_id, string $name, int $children_count)
    {
        $this->node_id = $node_id;
        $this->name = $name;
        $this->children_count = $children_count;
    }
}