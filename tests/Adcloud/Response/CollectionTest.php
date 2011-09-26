<?php

class Adcloud_Response_CollectionTest extends PHPUnit_Framework_TestCase
{
    public function testGetStatusCode()
    {
        $collection = new Adcloud_Response_Collection(200, array());
        $this->assertEquals(200, $collection->getStatusCode());
    }

    public function testGetResult()
    {
        $result = array('foo', 'bar');
        $collection = new Adcloud_Response_Collection(200, $result);
        $this->assertEquals($result, $collection->getResult());
    }

    public function testImplementsResponseInterface()
    {
        $collection = new Adcloud_Response_Collection(200, array());
        $interfaces = class_implements($collection);
        $this->assertContains('Adcloud_Response_Interface', $interfaces);
    }

    public function testExceptionIfResultIsNotAnArray()
    {
        $this->setExpectedException('InvalidArgumentException');
        new Adcloud_Response_Collection(200, '');
    }
}
