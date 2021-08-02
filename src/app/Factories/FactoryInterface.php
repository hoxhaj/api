<?php

namespace Api\Factories;

interface FactoryInterface
{
    /**
     * @param mixed ...$args
     * @return mixed
     */
    public static function build(...$args);
}