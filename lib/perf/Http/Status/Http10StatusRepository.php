<?php

namespace perf\Http\Status;

/**
 *
 *
 */
class Http10StatusRepository implements HttpStatusRepository
{

    /**
     * Associative array matching HTTP status codes to HTTP status reasons.
     *
     * @var {int:string}
     */
    private $statuses = array(
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        204 => 'No Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Moved Temporarily',
        304 => 'Not Modified',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
    );

    /**
     * Static constructor.
     *
     * @return Http10StatusRepository
     */
    public static function create()
    {
        static $instance;

        if (null === $instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     *
     *
     * @param int $httpStatusCode HTTP status code to use for the HTTP header string.
     * @return string
     * @throws \DomainException
     * @throws \InvalidArgumentException
     */
    public function get($httpStatusCode)
    {
        if (!$this->has($httpStatusCode)) {
            throw new \DomainException("Unknown HTTP status code: '{$httpStatusCode}'.");
        }

        $reason = $this->statuses[$httpStatusCode];

        return new HttpStatus('1.0', $httpStatusCode, $reason);
    }

    /**
     * Builds a HTTP status header string according to specified HTTP status code and HTTP version.
     *
     * @param int $httpStatusCode HTTP status code to use for the HTTP header string.
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function has($httpStatusCode)
    {
        if (!is_int($httpStatusCode)) {
            throw new \InvalidArgumentException("Invalid HTTP status code.");
        }

        if (array_key_exists($httpStatusCode, $this->statuses)) {
            return true;
        }

        return false;
    }
}
