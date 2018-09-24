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

use PHPUnit\Framework\TestCase;
use bTd\SNP\Client\Client;
use bTd\SNP\Protocol\Message\Request\NotifyRequest;
use bTd\SNP\Protocol\Message\Request\RegisterRequest;
use bTd\SNP\Protocol\Message\Request\ForwardRequest;
use bTd\SNP\Protocol\Message\Response;



class ClientTest extends TestCase
{

    protected $password;
    protected $server;
    protected $port;





    protected function setUp()
    {
        global $server;
        global $port;
        global $password;
        $this->password = $password ?? null;
        $this->server = $server ?? "127.0.0.1";
        $this->port = $port ?? 9731;

    }

    /**
     *  @expectedException \RuntimeException
     */
    public function testBadConnectionToServer() {
        @new Client("127.0.0.1", "1");
    }

    /**
     * @group RequireServer
     */
    public function testConnectionToServer()
    {
        $client = new Client($this->server, $this->port, $this->password);
        $this->assertInstanceOf(Client::class, $client);
        return $client;
    }

    /**
     * @group RequireServer
     * @depends testConnectionToServer
     */
    public function testClientSendNotifyResponse(Client $client) {
        $notify = new NotifyRequest("testTitle", "testText", "stock:system-urgent");
        $response=$client->notify($notify);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame( "SNP/3.1 SUCCESS\r\nEND\r\n", (string) $response);
    }

    /**
     * @group RequireServer
     * @depends testConnectionToServer
     */
    public function testClientSendRegisterAndNotifyResponse(Client $client) {
        $register = new RegisterRequest("testid", "TEST APPLICATION", "stock:system-urgent");
        $response=$client->register($register);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame( "SNP/3.1 SUCCESS\r\nEND\r\n", (string) $response);
        $notify = new NotifyRequest("testTitle", "testText", "stock:system-urgent");
        $response=$client->notify($notify);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame( "SNP/3.1 SUCCESS\r\nEND\r\n", (string) $response);

    }

    /**
     * @group RequireServer
     * @depends testConnectionToServer
     */
    public function testClientSendForwardResponse(Client $client) {
        $forward = new ForwardRequest("TEST APP","testTitle", "testText", "stock:system-urgent");
        $response=$client->forward($forward);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame( "SNP/3.1 SUCCESS\r\nEND\r\n", (string) $response);

    }
}