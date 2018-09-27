<?php
/**
 * Project: SNPClient
 *
 * @author    Peter Nerád <nerad.peter@gmail.com>
 * @copyright 2018 Peter Nerád
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace bTd\SNP\Protocol\Message\Request;

use bTd\SNP\Protocol\Message\Request;
use bTd\SNP\Protocol\Protocol;


/**
 * Class NotifyRequest
 *
 * @package bTd\SNP\Protocol\Message\Request
 * @TODO    Implemment Actions
 * @see     https://github.com/fullphat/snarl/wiki/Snarl-API-Reference#notify
 */
class NotifyRequest extends Request
{


    /**
     * NotifyRequest constructor.
     *
     * @param string $title    Notification title.
     * @param string $text     Notification text.
     * @param string $icon     Notification icon.
     * @param int    $duration Notification duration.
     * @param int    $priority Notification priority.
     * @param string $callback Notification callbak.
     */
    public function __construct(string $title, string $text, string $icon, int $duration=3, int $priority=0, string $callback="")
    {

        parent::__construct(Protocol::REQUEST_TYPE_NOTIFY);

        $this->addToContent("title", $title);
        $this->addToContent("text", $text);
        $this->addToContent("icon", $icon);
        $this->addToContent("duration", $duration);
        $this->addToContent("priority", $priority);
        $this->addToContent("callback", $callback);

    }//end __construct()


}//end class
