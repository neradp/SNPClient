<?php
/**
 * Copyright (c) 2018. Peter Nerád
 */

/**
 * Project: SNPClient
 * Author: Peter Nerád
 * Date: 15. 9. 2018
 * Time: 11:35
 */

namespace bTd\SNP\Protocol\Message;

use bTd\SNP\Protocol\Message;
use bTd\SNP\Protocol\Protocol;


/**
 * Class Request
 *
 * @package bTd\SNP\Protocol\Message
 * @see     https://github.com/fullphat/snarl/wiki/SNP-3.1#requests
 */
class Request extends Message
{



    /**
     * @var string Contain the type of request message.
     */
    private $requestType;


    /**
     * @param string $requestType Contain the type of request message.
     */
    public function __construct($requestType)
    {
            $this->setRequestType($requestType);

    }//end __construct()


    /**
     * Get type of request message.
     *
     * @return string Type of request message.
     */
    public function getRequestType(): string
    {
        return $this->requestType;

    }//end getRequestType()


    /**
     * Update header of message by the request type.
     *
     * @param  string $type Type of request message.
     * @throws \TypeError
     */
    protected function setRequestType(string $type)
    {
        if ($type !== Protocol::REQUEST_TYPE_NOTIFY && $type !== Protocol::REQUEST_TYPE_FORWARD && $type !== protocol::REQUEST_TYPE_REGISTER) {
            throw new \TypeError("Unsupported request type: $type!");
        }

        $this->requestType = $type;
        $this->setHeader(Protocol::VERSION." ".$type);

    }//end setRequestType()


    /**
     * Add authentication part to message header.
     *
     * @param  string $password
     * @throws \Exception
     * @see    https://github.com/fullphat/snarl/wiki/SNP-3.1#authentication https://github.com/fullphat/snarl/wiki/Snarl-Developer-Guide#authentication
     */
    public function authenticate(string $password)
    {
        $salt      = random_bytes(10);
        $key_basis = $password.$salt;
        $key       = hash(Protocol::PASSWORD_HASH_TYPE, $key_basis, true);
        $key_hash  = hash(Protocol::PASSWORD_HASH_TYPE, $key);
        $this->setHeader($this->getHeader()." ".strtoupper(Protocol::PASSWORD_HASH_TYPE.":$key_hash.".bin2hex($salt)));

    }//end authenticate()


    /**
     * Add registered application ID to message content, common routine for request messages.
     *
     * @param string $appID Registered Application ID.
     */
    public function setApplicationIdentification(string $appID): void
    {
        $this->addToContent("app-id", $appID);

    }//end setApplicationIdentification()


}//end class
