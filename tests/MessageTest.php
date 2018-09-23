<?php
/**
 * Copyright (c) 2018. Peter Nerád
 */

/**
 * Project: SNPClient
 * Author: Peter Nerád
 * Date: 22. 9. 2018
 * Time: 17:43
 */

use PHPUnit\Framework\TestCase;
use bTd\SNP\Protocol\Message;

class MessageTest extends TestCase
{

    public function testSetHeader(): Message
    {
        $msg = new Message();
        $msg->setHeader("TEST HEADER");
        $this->assertAttributeEquals("TEST HEADER", "header", $msg);
        return $msg;
    }

    /**
     * @depends testSetHeader
     */
    public function testGetHeader(Message $msg)
    {
        $this->assertEquals("TEST HEADER",$msg->getHeader());
    }

    public function testSetContent(): Message
    {
        $msg = new Message();
        $this->assertAttributeEmpty("content",$msg);
        $test = array(1,2,3);
        $msg->setContent($test);
        $this->assertAttributeSame($test,"content", $msg);
        return $msg;

    }
    /**
     * @depends testSetContent
     */
    public function testGetContent(Message $msg)
    {
        $this->assertSame(array(1,2,3), $msg->getContent());
    }

    /**
     * @depends testSetHeader
     */
    public function testAddToContent(Message $msg)
    {
        $msg->addToContent("testParam", 'testValue');
        $this->assertSame(array("testParam"=>"testValue"),$msg->getContent());
        return $msg;
    }

    /**
     * @depends testAddToContent
     */
    public function testGetFromContent(Message $msg)
    {
        $this->assertSame('testValue', $msg->getFromContent('testParam'));
    }


    /**
     * @depends testAddToContent
     */
    public function testGetTerminator(Message $msg)
    {
        $this->assertSame("END", $msg->getTerminator());
    }

    /**
     * @depends testAddToContent
     */
    public function testRawMessageFormat(Message $msg)
    {
        $this->assertEquals("TEST HEADER\r\ntestParam: testValue\r\nEND\r\n", $msg);
    }


}