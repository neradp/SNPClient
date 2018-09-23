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
use bTd\SNP\Protocol\Message\Request\RegisterRequest;

class RegisterRequestTest extends TestCase
{
    public function testRegisterRequest()
    {
        $register = new RegisterRequest("testApp","testTitle",  "testIcon");

        $this->assertSame('REGISTER', $register->getRequestType());
        $this->assertSame('testTitle', $register->getFromContent('title'));
        $this->assertSame('testApp', $register->getApplicationIdentification());
        $this->assertSame('testIcon', $register->getFromContent('icon'));

    }
}