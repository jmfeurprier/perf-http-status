<?php

namespace perf\HttpStatus;

use DomainException;

interface HttpStatusRepositoryInterface
{
    /**
     * Builds a HTTP status according to provided HTTP status code.
     *
     * @param int $httpStatusCode HTTP status code to use for the HTTP header string.
     *
     * @return HttpStatus
     *
     * @throws DomainException
     */
    public function get(int $httpStatusCode): HttpStatus;

    /**
     * Tells wether provided HTTP status code exists.
     *
     * @param int $httpStatusCode HTTP status code to use for the HTTP header string.
     *
     * @return bool
     */
    public function has(int $httpStatusCode): bool;
}
