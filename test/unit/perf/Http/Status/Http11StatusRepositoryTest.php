<?php

namespace perf\Http\Status;

/**
 *
 */
class Http11StatusRepositoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testGet()
    {
        $repository = new Http11StatusRepository();

        $result = $repository->get(404);

        $expectedHeader = "HTTP/1.1 404 Not Found";

        $this->assertInstanceOf('\\perf\\Http\\Status\\HttpStatus', $result);
        $this->assertSame($expectedHeader, $result->toHeader());
    }
}
