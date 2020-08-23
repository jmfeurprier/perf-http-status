<?php

namespace perf\HttpStatus\Protocol;

class Http10Protocol extends HttpProtocolBase
{
    public static function create(): self
    {
        return new self();
    }

    public function getHttpVersion(): string
    {
        return '1.0';
    }

    protected function getHttpStatusCodes(): array
    {
        return [
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
    }
}
