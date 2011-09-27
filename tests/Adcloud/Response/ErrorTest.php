<?php

/**
 * @covers Adcloud_Response_Error
 */
class Adcloud_Response_ErrorTest extends PHPUnit_Framework_TestCase
{
    public function testGetStatusCode()
    {
        $error = new Adcloud_Response_Error(200, array());
        $this->assertEquals(200, $error->getStatusCode());
    }

    public function testGetResult()
    {
        $result = array('foo', 'bar');
        $error = new Adcloud_Response_Error(200, $result);
        $this->assertEquals($result, $error->getResult());
    }

    public function testImplementsResponseInterface()
    {
        $error = new Adcloud_Response_Error(200, array());
        $interfaces = class_implements($error);
        $this->assertContains('Adcloud_Response_Interface', $interfaces);
    }

    public function testExceptionIfResultIsNotAnArray()
    {
        $this->setExpectedException('InvalidArgumentException');
        new Adcloud_Response_Error(200, '');
    }
}
