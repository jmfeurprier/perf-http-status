<?php

namespace perf\HttpStatus;

use perf\HttpStatus\Exception\HttpProtocolNotFoundException;
use perf\HttpStatus\Exception\HttpStatusException;
use perf\HttpStatus\Exception\HttpStatusNotFoundException;
use perf\HttpStatus\Protocol\HttpProtocolInterface;
use PHPUnit\Framework\TestCase;

class HttpStatusRepositoryTest extends TestCase
{
    /**
     * @var HttpProtocolInterface[]
     */
    private array $protocols = [];

    public function testDefaultInstanceSupportsHttp10AndHttp11()
    {
        $repository = HttpStatusRepository::createDefault();

        $this->assertTrue($repository->has(200, '1.0'));
        $this->assertTrue($repository->has(200, '1.1'));
    }

    public function testCannotInstanciateWithoutProtocol()
    {
        $this->expectException(HttpStatusException::class);

        new HttpStatusRepository([]);
    }

    public function testGetWithExistingHttpStatus()
    {
        $httpVersion    = '9.9';
        $httpStatusCode = 123;

        $this->givenProtocolWithHttpStatusCode($httpVersion, $httpStatusCode);

        $repository = new HttpStatusRepository($this->protocols);

        $result = $repository->get($httpStatusCode, $httpVersion);

        $this->assertInstanceOf(HttpStatusInterface::class, $result);
    }

    public function testGetWithNonExistingHttpProtocol()
    {
        $httpVersion      = '9.9';
        $httpStatusCode   = 123;
        $httpVersionOther = '8.8';

        $this->givenProtocolWithHttpStatusCode($httpVersion, $httpStatusCode);

        $repository = new HttpStatusRepository($this->protocols);

        $this->expectException(HttpProtocolNotFoundException::class);

        $repository->get($httpStatusCode, $httpVersionOther);
    }

    public function testGetWithNonExistingHttpStatus()
    {
        $httpVersion    = '9.9';
        $httpStatusCode = 123;

        $this->givenProtocolWithoutHttpStatusCode($httpVersion, $httpStatusCode);

        $repository = new HttpStatusRepository($this->protocols);

        $this->expectException(HttpStatusNotFoundException::class);

        $repository->get($httpStatusCode, $httpVersion);
    }

    public function testHasWithNonExistingHttpProtocol()
    {
        $httpVersion      = '9.9';
        $httpStatusCode   = 123;
        $httpVersionOther = '8.8';

        $this->givenProtocolWithHttpStatusCode($httpVersion, $httpStatusCode);

        $repository = new HttpStatusRepository($this->protocols);

        $result = $repository->has($httpStatusCode, $httpVersionOther);

        $this->assertFalse($result);
    }

    public function testGetWithoutHttpVersionUsesFirstProtocolHttpStatus()
    {
        $httpVersionPrimary   = '1.1';
        $httpVersionSecondary = '2.2';
        $httpStatusCode       = 123;

        $this->givenProtocolWithHttpStatusCode($httpVersionPrimary, $httpStatusCode);
        $this->givenProtocolWithHttpStatusCode($httpVersionSecondary, $httpStatusCode);

        $repository = new HttpStatusRepository($this->protocols);

        $result = $repository->get($httpStatusCode);

        $this->assertSame($httpVersionPrimary, $result->getHttpVersion());
    }

    public function testHasWithoutHttpVersionUsesFirstProtocolHttpStatus()
    {
        $httpVersionPrimary   = '1.1';
        $httpVersionSecondary = '2.2';
        $httpStatusCode       = 123;

        $this->givenProtocolWithHttpStatusCode($httpVersionPrimary, $httpStatusCode);
        $this->givenProtocolWithoutHttpStatusCode($httpVersionSecondary, $httpStatusCode);

        $repository = new HttpStatusRepository($this->protocols);

        $result = $repository->has($httpStatusCode);

        $this->assertTrue($result);
    }

    private function givenProtocolWithHttpStatusCode(string $httpVersion, int $httpStatusCode): void
    {
        $httpStatus = $this->createMock(HttpStatusInterface::class);
        $httpStatus
            ->method('getHttpVersion')
            ->willReturn($httpVersion)
        ;
        $httpStatus
            ->method('getCode')
            ->willReturn($httpStatusCode)
        ;

        $protocol = $this->createMock(HttpProtocolInterface::class);
        $protocol
            ->method('getHttpVersion')
            ->willReturn($httpVersion)
        ;
        $protocol
            ->method('has')
            ->with($httpStatusCode)
            ->willReturn(true)
        ;
        $protocol
            ->method('getHttpStatus')
            ->with($httpStatusCode)
            ->willReturn($httpStatus)
        ;

        $this->protocols[] = $protocol;
    }

    private function givenProtocolWithoutHttpStatusCode(string $httpVersion, int $httpStatusCode): void
    {
        $protocol = $this->createMock(HttpProtocolInterface::class);

        $protocol
            ->method('getHttpVersion')
            ->willReturn($httpVersion)
        ;
        $protocol
            ->method('has')
            ->with($httpStatusCode)
            ->willReturn(false)
        ;
        $protocol
            ->method('getHttpStatus')
            ->with($httpStatusCode)
            ->willThrowException(
                new HttpStatusNotFoundException()
            )
        ;

        $this->protocols[] = $protocol;
    }
}
