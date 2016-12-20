<?php

namespace perf\Http\Status;

/**
 *
 *
 */
class Http11StatusRepository implements HttpStatusRepository
{

    /**
     * Associative array matching HTTP status codes to HTTP status reasons.
     *
     * @var {int:string}
     */
    private $statuses = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
    );

    /**
     * Static constructor.
     *
     * @return Http11StatusRepository
     */
    public static function create()
    {
        static $instance;

        if (null === $instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Builds a HTTP status according to provided HTTP status code.
     *
     * @param int $httpStatusCode HTTP status code to use for the HTTP header string.
     * @return HttpStatus
     * @throws \DomainException
     * @throws \InvalidArgumentException
     */
    public function get($httpStatusCode)
    {
        if (!$this->has($httpStatusCode)) {
            throw new \DomainException("Unknown HTTP status code: '{$httpStatusCode}'.");
        }

        $reason = $this->statuses[$httpStatusCode];

        return new HttpStatus('1.1', $httpStatusCode, $reason);
    }

    /**
     * Tells wether provided http status code exists.
     *
     * @param int $httpStatusCode HTTP status code to use for the HTTP header string.
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function has($httpStatusCode)
    {
        if (!is_int($httpStatusCode)) {
            throw new \InvalidArgumentException("Invalid HTTP status code.");
        }

        if (array_key_exists($httpStatusCode, $this->statuses)) {
            return true;
        }

        return false;
    }
}
