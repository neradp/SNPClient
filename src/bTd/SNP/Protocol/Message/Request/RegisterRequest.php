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
     * @param string $appID
     * @param string $title
     * @param string $icon
     * @param int    $keepAlive
     */
    public function __construct(string $appID, string $title, string $icon, int $keepAlive=1)
    {

        parent::__construct(Protocol::REQUEST_TYPE_REGISTER);
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
