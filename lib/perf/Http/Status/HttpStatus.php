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
     *
     *
     * @return string
     */
    public function toHeader()
    {
        return "HTTP/{$this->httpVersion} {$this->code} {$this->reason}";
    }
}
