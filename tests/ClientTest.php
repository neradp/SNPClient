<?php
/**
 * Copyright (c) 2018. Peter Nerád
 */

/**
 * Project: SNPClient
 * Author: Peter Nerád
 * Date: 22. 9. 2018
 * Time: 22:23
 */
namespace bTd\SNP\Client;

use Mockery;

function shell_exec($cmd)
{
    return YourTest::$functions->shell_exec($cmd);
}



use PHPUnit\Framework\TestCase;
use bTd\SNP\Client\Client;
use bTd\SNP\Protocol\Message\Request\NotifyRequest;
use bTd\SNP\Protocol\Message\Request\RegisterRequest;
use bTd\SNP\Protocol\Message\Request\ForwardRequest;




class ClientTest extends TestCase
{

    /**
     * @group RequireServer
     */
    public function testClientSendNotifyResponse() {
        $client = new Client("127.0.0.1");
        $notify = new NotifyRequest("testTitle", "testText", "stock:system-urgent");
        $response=$client->notify($notifyRequest);
        $this->assertSame($response, "SNP/3.1 SUCCESS\r\nEND\r\n");


    }

    /**
     * @group RequireServer
     */
    public function testClientSendRegisterAndNotifyResponse() {
        $client = new Client("127.0.0.1");
        $register = new RegisterRequest("testid", "testet application", "stock:system-urgent");
        $response=$client->register($register);
        $this->assertSame($response, "SNP/3.1 SUCCESS\r\nEND\r\n");
        $notify = new NotifyRequest("testTitle", "testText", "stock:system-urgent");
        $response=$client->notify($notify);
        $this->assertSame($response, "SNP/3.1 SUCCESS\r\nEND\r\n");

    }

    /**
     * @group RequireServer
     */
    public function testClientSendForwardResponse() {
        $client = new Client("127.0.0.1");
        $forward = new ForwardRequest("TEST APP","testTitle", "testText", "stock:system-urgent");
        $response=$client->forward($forward);
        $this->assertSame($response, "SNP/3.1 SUCCESS\r\nEND\r\n");


    }


}