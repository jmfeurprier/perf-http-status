<?php

namespace perf\HttpStatus\Protocol;

use perf\HttpStatus\Exception\HttpStatusNotFoundException;
use perf\HttpStatus\HttpStatusInterface;

interface HttpProtocolInterface
{
    public function getHttpVersion(): string;

    /**
     * @param int $httpStatusCode
     *
     * @return HttpStatusInterface
     *
     * @throws HttpStatusNotFoundException
     */
    public function getHttpStatus(int $httpStatusCode): HttpStatusInterface;

    public function has(int $httpStatusCode): bool;
}
