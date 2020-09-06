<?php

namespace perf\HttpStatus;

use perf\HttpStatus\Exception\HttpProtocolNotFoundException;
use perf\HttpStatus\Exception\HttpStatusNotFoundException;

interface HttpStatusRepositoryInterface
{
    /**
     * Builds a HTTP status according to provided HTTP status code.
     *
     * @param int         $httpStatusCode HTTP status code to use for the HTTP header string.
     * @param string|null $httpVersion
     *
     * @return HttpStatusInterface
     *
     * @throws HttpProtocolNotFoundException
     * @throws HttpStatusNotFoundException
     */
    public function get(int $httpStatusCode, string $httpVersion = null): HttpStatusInterface;

    public function has(int $httpStatusCode, string $httpVersion = null): bool;
}
