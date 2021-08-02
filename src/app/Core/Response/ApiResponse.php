<?php

namespace Api\Core\Response;

class ApiResponse
{
    /**
     * @param array $data
     * @param int $code
     * @param string|null $error
     */
    public static function withJson(array $data, int $code = 200, string $error = null)
    {
        $response = new Response();

        $response
            ->withJson([
                'nodes' => $data ?: null,
                'error' => $error,
            ])
            ->withCode($code)
            ->withHeaders([
                'Content-type: application/json'
            ])
            ->send();
    }
}