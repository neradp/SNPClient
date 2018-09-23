<?php
/**
 * Copyright (c) 2018. Peter Nerád
 */

/**
 * Project: SNPClient
 * Author: Peter Nerád
 * Date: 22. 9. 2018
 * Time: 20:22
 */

use PHPUnit\Framework\TestCase;
use bTd\SNP\Protocol\Message\Response;


class ResponseTest extends TestCase
{
    public function testSuccessResponse()
    {
        $response = new Response("SNP/3.1 SUCCESS\r\nEND\r\n");
        $this->assertSame(true, $response->isSuccess());

    }

    /**
     * @expectedException  \bTd\SNP\Protocol\Message\Response\ErrorResponseException
     *
     */
    public function testBrokenResponse()
    {
        $response = new Response("ABDFG");
    }

    /**
     * @expectedException  \bTd\SNP\Protocol\Message\Response\ErrorResponseException
     * @expectedExceptionMessage testError
     * @expectedExceptionCode 123
     */

    public function testFailedResponse() {
        $response = new Response("SNP/3.1 FAILED\r\nerror-name: testError\r\nerror-number: 123\r\nreason: test\r\nEND\r\n");

    }

}