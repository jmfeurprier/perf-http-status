<?php

namespace perf\HttpStatus;

use DomainException;
use PHPUnit\Framework\TestCase;

class Http11StatusRepositoryTest extends TestCase
{
    /**
     * @var Http11StatusRepository
     */
    private Http11StatusRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new Http11StatusRepository();
    }

    public function testCreate()
    {
        $result = Http11StatusRepository::create();

        $this->assertInstanceOf(Http11StatusRepository::class, $result);
    }

    public function testGetWithKnownStatus()
    {
        $result = $this->repository->get(404);

        $expectedHeader = "HTTP/1.1 404 Not Found";

        $this->assertInstanceOf(HttpStatus::class, $result);
        $this->assertSame($expectedHeader, $result->toHeader());
    }

    public function testGetWithUnknownStatus()
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Unknown HTTP status code');

        $this->repository->get(999999);
    }

    public function testHasWithKnownStatus()
    {
        $result = $this->repository->has(404);

        $this->assertTrue($result);
    }

    public function testHasWithUnknownStatus()
    {
        $result = $this->repository->has(999999);

        $this->assertFalse($result);
    }
}
