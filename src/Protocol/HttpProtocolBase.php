<?php

namespace perf\HttpStatus\Protocol;

use perf\HttpStatus\Exception\HttpStatusNotFoundException;
use perf\HttpStatus\HttpStatus;
use perf\HttpStatus\HttpStatusInterface;

abstract class HttpProtocolBase implements HttpProtocolInterface
{
    /**
     * {@inheritDoc}
     */
    public function getHttpStatus(int $httpStatusCode): HttpStatusInterface
    {
        if (!$this->has($httpStatusCode)) {
            throw new HttpStatusNotFoundException("Unknown HTTP status code: '{$httpStatusCode}'.");
        }

        $reason = $this->getHttpStatusCodes()[$httpStatusCode];

        return new HttpStatus($this->getHttpVersion(), $httpStatusCode, $reason);
    }

    /**
     * {@inheritDoc}
     */
    public function has(int $httpStatusCode): bool
    {
        return array_key_exists($httpStatusCode, $this->getHttpStatusCodes());
    }

    abstract protected function getHttpStatusCodes(): array;
}
