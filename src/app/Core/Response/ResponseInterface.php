<?php

namespace Api\Core\Response;

interface ResponseInterface
{
    /**
     * @param array $headers
     * @return mixed
     */
    public function withHeaders(array $headers);


    /**
     * @param int $code
     * @return mixed
     */
    public function withCode(int $code);


    /**
     * @param array $body
     * @return mixed
     */
    public function withJson(array $body);


    /**
     * @param array $body
     * @return mixed
     */
    public function write(array $body);


    /**
     * @return mixed
     */
    public function send();
}