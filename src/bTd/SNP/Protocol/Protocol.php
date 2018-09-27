<?php
/**
 * Project: SNPClient
 *
 * @author    Peter Nerád <nerad.peter@gmail.com>
 * @copyright 2018 Peter Nerád
 * @license   https://opensource.org/licenses/MIT MIT
 */

namespace bTd\SNP\Protocol;

/**
 * Class Protocol
 *
 * @package bTd\SNP\Protocol
 */
final class Protocol
{

    /**
     * @var string Contain supported protocol version,
     */
    public const VERSION = "SNP/3.1";

    /**
     * @var string Contain  the End Of Line string: CRLF.
     */
    public const EOL = "\r\n";

    /**
     * @var string Contain the message terminator.
     */
    public const TERMINATOR = "END";

    /**
     * @var string Notify request type identification.
     */
    public const REQUEST_TYPE_NOTIFY = "NOTIFY";

    /**
     * @var string Forward request type identification.
     */
    public const REQUEST_TYPE_FORWARD = "FORWARD";

    /**
     * @var string Register request type identification.
     */
    public const REQUEST_TYPE_REGISTER = "REGISTER";

    /**
     * @var string Success response type identification.
     */
    public const RESPONSE_TYPE_SUCCESS = "SUCCESS";

    /**
     * @var string Success response type identification.
     */
    public const RESPONSE_TYPE_FAILED = "FAILED";

    /**
     * @var string Supported hash.
     */
    public const PASSWORD_HASH_TYPE = "SHA256";

}//end class
