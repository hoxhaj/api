<?php

namespace Api\Repositories;

interface RepositoryInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function find(array $data);
}