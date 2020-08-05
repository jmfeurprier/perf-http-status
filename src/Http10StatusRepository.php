<?php

namespace perf\HttpStatus;

use DomainException;

class Http10StatusRepository implements HttpStatusRepositoryInterface
{
    private const VERSION = '1.0';

    private const STATUSES = [
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
    ];

    public static function create(): self
    {
        static $instance;

        if (null === $instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * {@inheritDoc}
     */
    public function get(int $httpStatusCode): HttpStatus
    {
        if (!$this->has($httpStatusCode)) {
            throw new DomainException("Unknown HTTP status code: '{$httpStatusCode}'.");
        }

        $reason = self::STATUSES[$httpStatusCode];

        return new HttpStatus(self::VERSION, $httpStatusCode, $reason);
    }

    /**
     * {@inheritDoc}
     */
    public function has(int $httpStatusCode): bool
    {
        return array_key_exists($httpStatusCode, self::STATUSES);
    }
}
