<?php

namespace Api\Core\Router;

use Api\Core\Response\Response;
use Api\Exceptions\RouterException;

class Router implements RouterInterface
{
    const CONTROLLERS_PATH = 'Api\Controllers\\';

    /**
     * @var array[]
     */
    private $httpRoutes = [
        'GET'       => [],
        'POST'      => [],
        'PUT'       => [],
        'PATCH'     => [],
        'DELETE'    => [],
    ];


    /**
     * @return string
     */
    private function getRoute()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode( '/', $uri );
        $uri = array_slice($uri, 2);

        return implode('/', $uri);
    }


    /**
     * Check if route is registered
     *
     * @param string $httpMethod
     * @return bool
     */
    private function checkRoute(string $httpMethod)
    {
        $route = $this->getRoute();

        if (!isset($this->httpRoutes[$httpMethod][$route]))
        {
            return false;
        }

        return true;
    }


    /**
     * Check if controller class and controller method exists
     *
     * @param array $controllerCall
     * @return bool
     */
    private function checkController(array $controllerCall)
    {
        // Destructuring array
        [$controller, $method] = $controllerCall;
        $class = self::CONTROLLERS_PATH . $controller;

        if (!class_exists($class))
        {
            return false;
        }

        if (!method_exists($class, $method))
        {
            return false;
        }

        return true;
    }


    /**
     * Handle GET Request (can be modified for future request methods)
     *
     * @throws RouterException
     */
    public function handleRequest()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if ($requestMethod !== 'GET')
        {
            throw new RouterException(Response::HTTP_405, 405);
        }

        $this->handle($requestMethod);
    }


    /**
     * Delegate the request to the responsible controller method
     *
     * @param string $httpMethod
     * @return mixed
     * @throws RouterException
     */
    private function handle(string $httpMethod)
    {
        if (!$this->checkRoute($httpMethod))
        {
            throw new RouterException(Response::HTTP_404, 404);
        }

        // Destructuring array
        [$controller, $method] = $this->httpRoutes[$httpMethod][$this->getRoute()];

        $class = self::CONTROLLERS_PATH . $controller;

        return (new $class)->$method($_REQUEST);
    }


    /**
     * Register GET route
     *
     * @param string $route
     * @param array $controllerCall
     * @throws RouterException
     */
    public function get(string $route, array $controllerCall)
    {
        if (!$this->checkController($controllerCall))
        {
            //TODO: log for specific error: 'Controller or method not exists'
            throw new RouterException(Response::HTTP_500, 500);
        }

        if (isset($this->httpRoutes['GET'][$route]))
        {
            //TODO: log for specific error: 'Route already exists'
            throw new RouterException(Response::HTTP_500, 500);
        }

        $this->httpRoutes['GET'][$route] = $controllerCall;
    }


    /**
     * @param string $route
     * @param array $controllerCall
     */
    public function post(string $route, array $controllerCall)
    {
        //TODO
    }


    /**
     * @param string $route
     * @param array $controllerCall
     */
    public function put(string $route, array $controllerCall)
    {
        //TODO
    }


    /**
     * @param string $route
     * @param array $controllerCall
     */
    public function patch(string $route, array $controllerCall)
    {
        //TODO
    }


    /**
     * @param string $route
     * @param array $controllerCall
     */
    public function delete(string $route, array $controllerCall)
    {
        //TODO
    }
}