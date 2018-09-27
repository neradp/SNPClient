<?php
/**
 * Project: SNPClient
 *
 * @author    Peter Nerád <nerad.peter@gmail.com>
 * @copyright 2018 Peter Nerád
 * @license   https://opensource.org/licenses/MIT MIT
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
     * @param string $type Type of request message.
     *
     * @return void
     * @throws \TypeError
     */
    protected function setRequestType(string $type):void
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
     * @param string $password
     *
     * @return void
     * @throws \Exception
     * @see    https://github.com/fullphat/snarl/wiki/SNP-3.1#authentication https://github.com/fullphat/snarl/wiki/Snarl-Developer-Guide#authentication
     */
    public function authenticate(string $password): void
    {
        $salt     = random_bytes(10);
        $keyBasis = $password.$salt;
        $key      = hash(Protocol::PASSWORD_HASH_TYPE, $keyBasis, true);
        $keyHash  = hash(Protocol::PASSWORD_HASH_TYPE, $key);
        $this->setHeader($this->getHeader()." ".strtoupper(Protocol::PASSWORD_HASH_TYPE.":$keyHash.".bin2hex($salt)));

    }//end authenticate()


    /**
     * Add registered application ID to message content, common routine for request messages.
     *
     * @param string $appID Registered Application ID.
     *
     * @return void
     */
    public function setApplicationIdentification(string $appID): void
    {
        $this->addToContent("app-id", $appID);

    }//end setApplicationIdentification()


}//end class
