<?php
/**
 * Project: SNPClient
 *
 * @author    Peter Nerád <nerad.peter@gmail.com>
 * @copyright 2018 Peter Nerád
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace bTd\SNP\Protocol\Message;

use bTd\SNP\Protocol\Message\Response\ErrorResponseException;
use bTd\SNP\Protocol\Message;
use bTd\SNP\Protocol\Protocol;

/**
 * Class Response
 *
 * @package bTd\SNP\Protocol\Message
 * @see     https://github.com/fullphat/snarl/wiki/SNP-3.1#response-structure
 */
class Response extends Message
{


    /**
     * Response constructor.
     *
     * @param string $response Raw response message.
     *
     * @throws ErrorResponseException
     */
    public function __construct(string $response)
    {

        $responseData = explode(Protocol::EOL, $response);
        $this->setHeader($responseData[0]);
        $length = (count($responseData) - 2);
        for ($i = 1; $i < $length; $i++) {
            list($key, $value) = explode(':', $responseData[$i]);
            $this->addToContent($key, trim($value));
        }

        // In case message is not success response throw exception.
        if ($this->isSuccess() !== true) {
            $this->throwErrorException();
        }

    }//end __construct()


    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        // Check to success response header.
        if (preg_match("#^".Protocol::VERSION." ".Protocol::RESPONSE_TYPE_SUCCESS."$#", $this->getHeader()) === 1) {
            return true;
        }

        // Everything else is bad.
        return false;

    }//end isSuccess()


    /**
     * @return void
     * @throws ErrorResponseException
     */
    protected function throwErrorException(): void
    {
        throw new ErrorResponseException($this->getFromContent('error-name'), (int) $this->getFromContent('error-number'), $this->getFromContent('reason'));

    }//end throwErrorException()


}//end class
