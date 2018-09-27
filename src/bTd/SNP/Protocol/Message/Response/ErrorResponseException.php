<?php
/**
 * Project: SNPClient
 *
 * @author    Peter Nerád <nerad.peter@gmail.com>
 * @copyright 2018 Peter Nerád
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace bTd\SNP\Protocol\Message\Response;


use Throwable;

/**
 * Class ErrorResponseException
 *
 * @package bTd\SNP\Protocol
 */
class ErrorResponseException extends \Exception
{
    /**
     * @var string
     */
    private $reason;


    /**
     * ErrorResponseException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param string         $reason
     * @param Throwable|null $previous
     */
    public function __construct(string $message="", int $code=0, string $reason="", Throwable $previous=null)
    {
        parent::__construct($message, $code, $previous);
        $this->reason = $reason;

    }//end __construct()


    /**
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;

    }//end getReason()


}//end class
