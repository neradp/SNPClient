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
use bTd\SNP\Protocol\Message\Request\NotifyRequest;

class NotifyRequestTest extends TestCase
{
    public function testNotifyRequest()
    {
        $notify = new NotifyRequest("testTitle", "testText", "testIcon");

        $this->assertSame('NOTIFY', $notify->getRequestType());
        $this->assertSame('testTitle', $notify->getFromContent('title'));
        $this->assertSame('testText', $notify->getFromContent('text'));
        $this->assertSame('testIcon', $notify->getFromContent('icon'));

    }
}