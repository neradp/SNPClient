<?php
/**
 * Copyright (c) 2018. Peter Nerád
 */

/**
 * Project: SNPClient
 * Author: Peter Nerád
 * Date: 22. 9. 2018
 * Time: 17:01
 */

use PHPUnit\Framework\TestCase;
use bTd\SNP\Protocol\Protocol;

class ProtocolTest extends TestCase
{
    public function testIsProtocolVersionSupported()
    {
        $this->assertEquals('SNP/3.1', Protocol::VERSION);
    }
}