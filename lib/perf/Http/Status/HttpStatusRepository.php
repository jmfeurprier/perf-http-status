<?php

namespace perf\Http\Status;

/**
 *
 *
 */
interface HttpStatusRepository
{

    /**
     *
     *
     * @param int $httpStatusCode HTTP status code to use for the HTTP header string.
     * @return string
     * @throws \DomainException
     * @throws \InvalidArgumentException
     */
    public function get($httpStatusCode);

    /**
     * Builds a HTTP status header string according to specified HTTP status code and HTTP version.
     *
     * @param int $httpStatusCode HTTP status code to use for the HTTP header string.
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function has($httpStatusCode);
}
