<?php
/**
 * Copyright (c) 2018. Peter Nerád
 */

/**
 * Project: SNPClient
 * Author: Peter Nerád
 * Date: 22. 9. 2018
 * Time: 22:06
 */

use PHPUnit\Framework\TestCase;
use bTd\SNP\Protocol\Message\Request\ForwardRequest;

class ForwardRequestTest extends TestCase
{
    public function testForwardRequest()
    {
        $forward = new ForwardRequest("testApp","testTitle", "testText", "testIcon");

        $this->assertSame('FORWARD', $forward->getRequestType());
        $this->assertSame('testTitle', $forward->getFromContent('title'));
        $this->assertSame('testApp', $forward->getFromContent('source'));
        $this->assertSame('testText', $forward->getFromContent('text'));
        $this->assertSame('testIcon', $forward->getFromContent('icon'));

    }
}