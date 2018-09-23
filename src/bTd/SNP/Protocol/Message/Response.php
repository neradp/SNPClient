<?php
/**
 * Copyright (c) 2018. Peter Nerád
 */

/**
 * Project: SNPClient
 * Author: Peter Nerád
 * Date: 17. 9. 2018
 * Time: 22:16
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
     * @param  string $response Raw response message.
     * @throws ErrorResponseException
     */
    public function __construct(string $response)
    {

        $responseData = explode(Protocol::EOL, $response);
        $this->setHeader($responseData[0]);

        for ($i = 1; $i < (sizeof($responseData) - 2); $i++) {
            list($k, $v) = explode(':', $responseData[$i]);
            $this->addToContent($k, trim($v));
        }

        // in case message is not success response throw exception
        if (!$this->isSuccess()) {
            $this->throwErrorException();
        }

    }//end __construct()


    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        // check to success response header
        if (preg_match("#^".Protocol::VERSION." ".Protocol::RESPONSE_TYPE_SUCCESS."$#", $this->getHeader())) {
            return true;
        }

        // everything else is bad
        return false;

    }//end isSuccess()


    /**
     * @throws ErrorResponseException
     */
    protected function throwErrorException(): \Exception
    {
        throw new ErrorResponseException($this->getFromContent('error-name'), (int)$this->getFromContent('error-number'), $this->getFromContent('reason'));

    }//end throwErrorException()


}//end class
