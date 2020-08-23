<?php

namespace perf\HttpStatus\Protocol;

use perf\HttpStatus\Exception\HttpStatusNotFoundException;
use perf\HttpStatus\HttpStatusInterface;
use PHPUnit\Framework\TestCase;

class Http11ProtocolTest extends TestCase
{
    private Http11Protocol $protocol;

    protected function setUp(): void
    {
        $this->protocol = new Http11Protocol();
    }

    public function testCreate()
    {
        $result = Http11Protocol::create();

        $this->assertInstanceOf(Http11Protocol::class, $result);
    }

    public function testGetWithKnownStatus()
    {
        $result = $this->protocol->getHttpStatus(404);

        $expectedHeader = "HTTP/1.1 404 Not Found";

        $this->assertInstanceOf(HttpStatusInterface::class, $result);
        $this->assertSame($expectedHeader, $result->toHeader());
    }

    public function testGetWithUnknownStatus()
    {
        $this->expectException(HttpStatusNotFoundException::class);
        $this->expectExceptionMessage('Unknown HTTP status code');

        $this->protocol->getHttpStatus(999999);
    }

    public function testHasWithKnownStatus()
    {
        $result = $this->protocol->has(404);

        $this->assertTrue($result);
    }

    public function testHasWithUnknownStatus()
    {
        $result = $this->protocol->has(999999);

        $this->assertFalse($result);
    }
}
