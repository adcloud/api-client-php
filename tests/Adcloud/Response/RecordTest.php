<?php

/**
 * @covers Adcloud_Response_Record
 */
class Adcloud_Response_RecordTest extends PHPUnit_Framework_TestCase
{
    public function testGetResult()
    {
        $record = new Adcloud_Response_Record(0, 'foo');
        $this->assertEquals('foo', $record->getResult());
    }

    public function testGetStatusCode()
    {
        $record = new Adcloud_Response_Record(200, '');
        $this->assertEquals(200, $record->getStatusCode());
    }

    public function testImplementsResponseInterface()
    {
        $record = new Adcloud_Response_Record(200, '');
        $interfaces = class_implements($record);
        $this->assertContains('Adcloud_Response_Interface', $interfaces);
    }
}
