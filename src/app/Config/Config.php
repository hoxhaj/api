<?php

namespace Api\Config;

final class Config
{
    const DB_HOST = 'db';
    const DB_NAME = 'nested_set_mode';
    const DB_USER = 'admin';
    const DB_PASS = 'test';
    const DB_PORT = '3306';

    /**
     * Deny instantiation
     */
    private function __construct()
    {
        //
    }
}