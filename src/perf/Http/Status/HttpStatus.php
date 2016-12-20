<?php

namespace perf\Http\Status;

/**
 *
 *
 */
class HttpStatus
{

    /**
     * HTTP version.
     *
     * @var string
     */
    private $httpVersion;

    /**
     * HTTP status code.
     *
     * @var int
     */
    private $code;

    /**
     * HTTP status reason.
     *
     * @var string
     */
    private $reason;

    /**
     * Constructor.
     *
     * @param string $httpVersion
     * @param int $code
     * @param string $reason
     * @return void
     */
    public function __construct($httpVersion, $code, $reason)
    {
        $this->httpVersion = (string) $httpVersion;
        $this->code        = (int) $code;
        $this->reason      = (string) $reason;
    }

    /**
     * Returns HTTP version.
     *
     * @return string
     */
    public function getHttpVersion()
    {
        return $this->httpVersion;
    }

    /**
     * Returns HTTP status code.
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Returns HTTP status reason.
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Converts HTTP status into a HTTP header string.
     *
     * @return string
     */
    public function toHeader()
    {
        return "HTTP/{$this->httpVersion} {$this->code} {$this->reason}";
    }
}
