<?php

namespace Api\Database;

interface DatabaseInterface
{
    /**
     * Get DB connection
     *
     * @return mixed
     */
    public function getConnection();
}