<?php
/**
 * Copyright (c) 2018. Peter Nerád
 */

/**
 * Project: SNPClient
 * Author: Peter Nerád
 * Date: 15. 9. 2018
 * Time: 10:49
 */

namespace bTd\SNP\Protocol;


/**
 * Class Message
 *
 * @package bTd\SNP\Protocol
 * @see     https://github.com/fullphat/snarl/wiki/SNP-3.1#message-structure
 */
class Message
{

    /**
     * @var string Contain the header part of the message.
     */
    private $header;
    /**
     * @var array Contain the content part of the message.
     */
    private $content = [];
    /**
     * @var string Contain the terminator part of the message.
     */
    private $terminator = Protocol::TERMINATOR;


    /**
     * Get the whole  content part of the message.
     *
     * @return array The whole content part of message.
     */
    public function getContent(): array
    {
        return $this->content;

    }//end getContent()


    /**
     * Set the whole content part of the message.
     *
     * @param array $conntent The whole content part of message.
     */
    public function setContent(array $content): void
    {
        $this->content = $content;

    }//end setContent()


    /**
     * Add a named value to the content part of message.
     *
     * @param string $param Name.
     * @param string $value Value.
     */
    public function addToContent(string $param, string $value): void
    {
        $this->content[$param] = $value;

    }//end addToContent()


    /**
     * Get a value from the content part of message by its name.
     *
     * @param  string $param Name.
     * @return string Value.
     */
    public function getFromContent(string $param): string
    {
        return $this->content[$param] ?? "";

    }//end getFromContent()


    /**
     * Compose message to raw format.
     *
     * @return string  The raw format of message.
     */
    public function __toString(): string
    {
        $str = $this->getHeader().Protocol::EOL;

        foreach ($this->content as $param => $value) {
            $str .= $param.": ".$value.Protocol::EOL;
        }

        $str .= $this->getTerminator().Protocol::EOL;
        return $str;

    }//end __toString()


    /**
     * Get the header part of the message.
     *
     * @return string The message header.
     */
    public function getHeader(): string
    {
        return $this->header;

    }//end getHeader()


    /**
     * Set the header part of the message.
     *
     * @param string $header The message header.
     */
    public function setHeader(string $header): void
    {
        $this->header = $header;

    }//end setHeader()


    /**
     * Get the terminator part of the message.
     *
     * @return string The terminator part of message.
     */
    public function getTerminator(): string
    {
        return $this->terminator;

    }//end getTerminator()


}//end class
