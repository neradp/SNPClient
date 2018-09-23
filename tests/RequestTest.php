<?php
/**
 * Copyright (c) 2018. Peter Nerád
 */

/**
 * Project: SNPClient
 * Author: Peter Nerád
 * Date: 22. 9. 2018
 * Time: 21:13
 */

use PHPUnit\Framework\TestCase;
use bTd\SNP\Protocol\Message\Request;

class RequestTest extends TestCase
{
    /**
     * @expectedException \TypeError
     * @expectedExceptionMessage Unsupported request type: ABC!
     */
    public function testSetInvalidRequestType() {
        new Request('ABC');
    }

    public function testSetRequestType()
    {
        $request= new Request('NOTIFY');

        $this->assertAttributeSame("NOTIFY", "requestType", $request);
        $this->assertSame("SNP/3.1 NOTIFY",  $request->getHeader());
        return $request;
    }

    /**
     * @depends testSetRequestType
     */
    public function testGetRequestType(Request $req)
    {
            $this->assertSame("NOTIFY",$req->getRequestType());
    }

    public function testAuthenticate() {
        $request = new Request('NOTIFY');
        $password = "TesTPasWorD";
        $request->authenticate($password);
        $header = $request->getHeader();
        $this->assertRegExp("#SNP/3\.1 NOTIFY SHA256:[A-F0-9]+\.[A-F0-9]+#", $header);

        preg_match("#SNP/3\.1 NOTIFY SHA256:[A-F0-9]+\.([A-F0-9]+)#", $header, $matches);
        $salt_hash = $matches[1];
        $salt = hex2bin($salt_hash);

        $key_basis = $password.$salt;
        $key       = hash("SHA256", $key_basis, true);
        $key_hash  = hash("SHA256", $key);

        $this->assertSame("SNP/3.1 NOTIFY SHA256:".strtoupper($key_hash.".".bin2hex($salt)), $header);
    }

    public function testSetApplicationIdentification()
    {
        $request = new Request('NOTIFY');
        $request->setApplicationIdentification("TESTID");
        $this->assertSame('TESTID', $request->getFromContent('app-id'));
    }


}