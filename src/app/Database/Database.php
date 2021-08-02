<?php


namespace Api\Database;


abstract class Database implements DatabaseInterface
{
    /**
     * @var
     */
    protected $connection;


    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }
}