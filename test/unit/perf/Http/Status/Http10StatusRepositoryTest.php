<?php

namespace perf\Http\Status;

/**
 *
 */
class Http10StatusRepositoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    protected function setUp()
    {
        $this->repository = new Http10StatusRepository();
    }

    /**
     *
     */
    public function testGetWithKnownStatus()
    {
        $result = $this->repository->get(404);

        $expectedHeader = "HTTP/1.0 404 Not Found";

        $this->assertInstanceOf('\\perf\\Http\\Status\\HttpStatus', $result);
        $this->assertSame($expectedHeader, $result->toHeader());
    }

    /**
     *
     * @expectedException \DomainException
     * @expectedExceptionMessage Unknown HTTP status code
     */
    public function testGetWithUnknownStatus()
    {
        $this->repository->get(999999);
    }

    /**
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid HTTP status code.
     */
    public function testGetWithInvalidStatusType()
    {
        $this->repository->get("404");
    }

    /**
     *
     */
    public function testHasWithKnownStatus()
    {
        $result = $this->repository->has(404);

        $this->assertTrue($result);
    }

    /**
     *
     */
    public function testHasWithUnknownStatus()
    {
        $result = $this->repository->has(999999);

        $this->assertFalse($result);
    }

    /**
     *
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid HTTP status code.
     */
    public function testHasWithInvalidStatusType()
    {
        $this->repository->has("404");
    }
}
