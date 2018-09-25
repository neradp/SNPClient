<?php
/**
 * Copyright (c) 2018. Peter Nerád
 */

/**
 * Project: SNPClient
 * Author: Peter Nerád
 * Date: 19. 9. 2018
 * Time: 22:55
 */

namespace bTd\SNP\Protocol\Message\Request;

use bTd\SNP\Protocol\Message\Request;
use bTd\SNP\Protocol\Protocol;

/**
 * Class RegisterRequest
 *
 * @package bTd\SNP\Protocol\Message\Request
 * @see     https://github.com/fullphat/snarl/wiki/Snarl-API-Reference#register
 */
class RegisterRequest extends Request
{


    /**
     * RegisterRequest constructor.
     *
     * @param string $appSig
     * @param string $title
     * @param string $icon
     * @param int    $keep_alive
     */
    public function __construct(string $appID, string $title, string $icon, int $keepAlive=1)
    {

        $this->setRequestType(Protocol::REQUEST_TYPE_REGISTER);

        $this->addToContent("app-id", $appID);
        $this->addToContent("title", $title);
        $this->addToContent("icon", $icon);
        $this->addToContent("keep-alive", $keepAlive);

    }//end __construct()


    /**
     * @return string
     */
    public function getApplicationIdentification(): string
    {
        return $this->getFromContent("app-id");

    }//end getApplicationIdentification()


}//end class
