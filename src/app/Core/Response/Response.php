<?php

namespace Api\Core\Response;

class Response implements ResponseInterface
{
    const HTTP_400 = 'Bad request';
    const HTTP_404 = 'Not found';
    const HTTP_405 = 'Method not allowed';
    const HTTP_500 = 'Internal server error';

    /**
     * @var null
     */
    private $body = null;

    /**
     * @var string[]
     */
    private $headers = ['Content-type: text/html'];

    /**
     * @var int
     */
    private $code = 200;


    /**
     * @param array $headers
     * @return $this|mixed
     */
    public function withHeaders(array $headers)
    {
        $this->headers = $headers;
        return $this;
    }


    /**
     * @param int $code
     * @return $this|mixed
     */
    public function withCode(int $code)
    {
        $this->code = $code;
        return $this;
    }


    /**
     * @param array $body
     * @return $this|mixed
     */
    public function withJson(array $body)
    {
        $this->body = json_encode($body);
        return $this;
    }


    /**
     * @return mixed|void
     */
    public function send()
    {
        http_response_code($this->code);

        foreach ($this->headers as $header)
        {
            header($header);
        }

        exit($this->body);
    }


    /**
     * @param array $body
     * @return mixed|void
     */
    public function write(array $body)
    {
        // TODO: Implement write() method.
    }
}