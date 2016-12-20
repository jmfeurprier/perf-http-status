<?php

namespace perf\Http\Status;

/**
 *
 *
 */
interface HttpStatusRepository
{

    /**
     * Builds a HTTP status according to provided HTTP status code.
     *
     * @param int $httpStatusCode HTTP status code to use for the HTTP header string.
     * @return HttpStatus
     * @throws \DomainException
     * @throws \InvalidArgumentException
     */
    public function get($httpStatusCode);

    /**
     * Tells wether provided http status code exists.
     *
     * @param int $httpStatusCode HTTP status code to use for the HTTP header string.
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function has($httpStatusCode);
}
