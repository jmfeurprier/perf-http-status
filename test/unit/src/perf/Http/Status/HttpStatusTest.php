<?php

namespace perf\Http\Status;

/**
 *
 */
class HttpStatusTest extends \PHPUnit_Framework_TestCase
{

    /**
     *
     */
    public function testGetHttpVersion()
    {
        $httpVersion = '1.23';
        $code        = 234;
        $reason      = 'foo';

        $status = new HttpStatus($httpVersion, $code, $reason);

        $this->assertSame($httpVersion, $status->getHttpVersion());
    }

    /**
     *
     */
    public function testGetCode()
    {
        $httpVersion = '1.23';
        $code        = 234;
        $reason      = 'foo';

        $status = new HttpStatus($httpVersion, $code, $reason);

        $this->assertSame($code, $status->getCode());
    }

    /**
     *
     */
    public function testGetReason()
    {
        $httpVersion = '1.23';
        $code        = 234;
        $reason      = 'foo';

        $status = new HttpStatus($httpVersion, $code, $reason);

        $this->assertSame($reason, $status->getReason());
    }

    /**
     *
     */
    public function testToHeader()
    {
        $httpVersion = '1.23';
        $code        = 234;
        $reason      = 'foo';

        $status = new HttpStatus($httpVersion, $code, $reason);

        $expected = "HTTP/1.23 234 foo";

        $this->assertSame($expected, $status->toHeader());
    }
}
