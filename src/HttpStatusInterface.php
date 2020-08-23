<?php

namespace perf\HttpStatus;

interface HttpStatusInterface
{
    public function getHttpVersion(): string;

    public function getCode(): int;

    public function getReason(): string;

    public function toHeader(): string;
}
