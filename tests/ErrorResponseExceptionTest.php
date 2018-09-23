<?php
/**
 * Copyright (c) 2018. Peter Nerád
 */

/**
 * Project: SNPClient
 * Author: Peter Nerád
 * Date: 22. 9. 2018
 * Time: 20:47
 */

use PHPUnit\Framework\TestCase;
use bTd\SNP\Protocol\Message\Response\ErrorResponseException;

class ErrorResponseExceptionTest extends TestCase
{
    public function testException() {
        $exception = new ErrorResponseException("testError", 123, "testReason");

        $this->assertSame('testReason', $exception->getReason());
        $this->assertSame(123, $exception->getCode());
        $this->assertSame('testError', $exception->getMessage());
    }
}