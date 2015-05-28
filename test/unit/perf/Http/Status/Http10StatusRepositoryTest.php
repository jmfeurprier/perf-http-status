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
    public function testGet()
    {
        $repository = new Http10StatusRepository();

        $result = $repository->get(404);

        $expectedHeader = "HTTP/1.0 404 Not Found";

        $this->assertInstanceOf('\\perf\\Http\\Status\\HttpStatus', $result);
        $this->assertSame($expectedHeader, $result->toHeader());
    }
}
