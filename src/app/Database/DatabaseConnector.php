<?php

namespace Api\Database;

use Api\Config\Config;

class DatabaseConnector extends Database
{
    /**
     * DatabaseConnector constructor.
     */
    public function __construct()
    {
        $this->connection = new \PDO(
            'mysql:host=' . Config::DB_HOST
            . ';dbname=' . Config::DB_NAME
            . ';charset=utf8mb4;port=' . Config::DB_PORT,
            Config::DB_USER,
            Config::DB_PASS
        );
    }
}