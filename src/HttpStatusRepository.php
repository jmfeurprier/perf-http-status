<?php

namespace perf\HttpStatus;

use perf\HttpStatus\Exception\HttpProtocolNotFoundException;
use perf\HttpStatus\Exception\HttpStatusException;
use perf\HttpStatus\Protocol\Http10Protocol;
use perf\HttpStatus\Protocol\Http11Protocol;
use perf\HttpStatus\Protocol\HttpProtocolInterface;

class HttpStatusRepository implements HttpStatusRepositoryInterface
{
    /**
     * @var {string:HttpProtocolInterface}
     */
    private array $httpProtocols = [];

    public static function createDefault()
    {
        return new self(
            [
                Http11Protocol::create(),
                Http10Protocol::create(),
            ]
        );
    }

    public function __construct(array $httpProtocols)
    {
        if (empty($httpProtocols)) {
            throw new HttpStatusException('No HTTP protocol provided.');
        }

        foreach ($httpProtocols as $protocol) {
            $this->addHttpProtocol($protocol);
        }
    }

    private function addHttpProtocol(HttpProtocolInterface $httpProtocol)
    {
        $httpVersion = $httpProtocol->getHttpVersion();

        $this->httpProtocols[$httpVersion] = $httpProtocol;
    }

    /**
     * {@inheritDoc}
     */
    public function get(int $httpStatusCode, string $httpVersion = null): HttpStatusInterface
    {
        return $this->getHttpProtocol($httpVersion)->getHttpStatus($httpStatusCode);
    }

    /**
     * {@inheritDoc}
     */
    public function has(int $httpStatusCode, string $httpVersion = null): bool
    {
        if (!$this->hasHttpProtocol($httpVersion)) {
            return false;
        }

        return $this->getHttpProtocol($httpVersion)->has($httpStatusCode);
    }

    /**
     * @param string|null $httpVersion
     *
     * @return HttpProtocolInterface
     *
     * @throws HttpProtocolNotFoundException
     */
    private function getHttpProtocol(?string $httpVersion): HttpProtocolInterface
    {
        if (null === $httpVersion) {
            return reset($this->httpProtocols);
        }

        if ($this->hasHttpProtocol($httpVersion)) {
            return $this->httpProtocols[$httpVersion];
        }

        throw new HttpProtocolNotFoundException();
    }

    private function hasHttpProtocol(?string $httpVersion): bool
    {
        if (null === $httpVersion) {
            return true;
        }

        return array_key_exists($httpVersion, $this->httpProtocols);
    }
}
