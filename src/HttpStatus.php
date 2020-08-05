<?php

namespace perf\HttpStatus;

class HttpStatus
{
    private string $httpVersion;

    private int $code;

    private string $reason;

    public function __construct(string $httpVersion, int $code, string $reason)
    {
        $this->httpVersion = $httpVersion;
        $this->code        = $code;
        $this->reason      = $reason;
    }

    public function getHttpVersion(): string
    {
        return $this->httpVersion;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function toHeader(): string
    {
        return "HTTP/{$this->httpVersion} {$this->code} {$this->reason}";
    }
}
