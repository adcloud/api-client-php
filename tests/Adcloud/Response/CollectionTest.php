<?php

/**
 * @covers Adcloud_Response_Collection
 */
class Adcloud_Response_CollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @param int $status
     * @param array $result
     * @param array $metadata
     * @return Adcloud_Response_Collection
     */
    private function getCollection($status = null, array $result = null, 
        array $metadata = null)
    {
        if ($status === null) {
            $status = 200;
        }

        if ($result === null) {
            $result = array();
        }

        $defaultMetadata = array();
        if ($metadata === null) {
            $metadata = $defaultMetadata;
        } else {
            $metadata = array_merge($metadata, $defaultMetadata);
        }

        return new Adcloud_Response_Collection($status, $result, $metadata);
    }

    public function testGetStatusCode()
    {
        $collection = $this->getCollection(200);
        $this->assertEquals(200, $collection->getStatusCode());
    }

    public function testGetResult()
    {
        $result = array('foo', 'bar');
        $collection = $this->getCollection(200, $result);
        $this->assertEquals($result, $collection->getResult());
    }

    public function testImplementsResponseInterface()
    {
        $collection = $this->getCollection();
        $interfaces = class_implements($collection);
        $this->assertContains('Adcloud_Response_Interface', $interfaces);
    }

    public function testExceptionIfResultIsNotAnArray()
    {
        $this->setExpectedException('InvalidArgumentException');
        new Adcloud_Response_Collection(200, '');
    }
}
