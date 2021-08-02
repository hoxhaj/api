<?php

require_once 'vendor/autoload.php';

use Api\Core\Router\Router;
use Api\Core\Response\ApiResponse;
use Api\Exceptions\RouterException;
use Api\Core\Response\Response;


try {
    $router = new Router();

    // Route definition
    $router->get('search', ['NestedTreeController', 'search']);

    $router->handleRequest();
}
catch (RouterException $e) {
    ApiResponse::withJson([], $e->getCode(), $e->getMessage());
}
catch (\Exception $e) {
    ApiResponse::withJson([], 500, Response::HTTP_500);
}
