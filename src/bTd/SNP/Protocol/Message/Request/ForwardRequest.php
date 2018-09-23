<?php
/**
 * Copyright (c) 2018. Peter Nerád
 */

/**
 * Project: SNPClient
 * Author: Peter Nerád
 * Date: 17. 9. 2018
 * Time: 23:53
 */

namespace bTd\SNP\Protocol\Message\Request;

use bTd\SNP\Protocol\Message\Request;
use bTd\SNP\Protocol\Protocol;


/**
 * Class ForwardRequest
 * @package bTd\SNP\Protocol\Message\Request
 * @TODO Implemment Actions
 * @see https://github.com/fullphat/snarl/wiki/Snarl-API-Reference#forward
 */
class ForwardRequest extends  Request
{


    /**
     * ForwardRequest constructor.
     * @param string $source From which application came request.
     * @param string $title  Notification title.
     * @param string $text   Notification text.
     * @param string $icon   Notification icon.
     * @param int $timeout   Notification timeout.
     * @param int $priority  Notification priority.
     * @param string $callback  Notification callback.
     */
    public function __construct(string $source, string $title, string $text, string $icon, int $timeout=0, int $priority=-1, string $callback="")
    {

        $this->setRequestType(Protocol::REQUEST_TYPE_FORWARD);

        $this->addToContent("source", $source);
        $this->addToContent("title", $title);
        $this->addToContent("text", $text);
        $this->addToContent("icon", $icon);
        $this->addToContent("timeout", $timeout);
        $this->addToContent("priority", $priority);
        $this->addToContent("callback", $callback);

    }//end __construct()


}//end class
