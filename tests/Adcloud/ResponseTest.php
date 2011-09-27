<?php

/**
 * @covers Adcloud_Response
 */
class Adcloud_ResponseTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    private function getRecordArray()
    {
        return array(
            'status' => 200,
            'result' => 'foo'
        );
    }

    /**
     * @return array
     */
    private function getCollectionArray()
    {
        return array(
            'status' => 200,
            'result' => array(),
            'collection' => array()
        );
    }

    /**
     * @return array
     */
    private function getErrorArray()
    {
        return array(
            'status' => 401,
            'result' => null,
            'errors' => array('foo'),
        );
    }

    public function testErrorFromJson()
    {
        $json = json_encode($this->getErrorArray());
        $record = Adcloud_Response::fromJson($json);
        $this->assertTrue($record instanceof Adcloud_Response_Error);
    }

    public function testRecordFromJson()
    {
        $json = json_encode($this->getRecordArray());
        $record = Adcloud_Response::fromJson($json);
        $this->assertTrue($record instanceof Adcloud_Response_Record);
    }

    public function testCollectionFromJson()
    {
        $json = json_encode($this->getCollectionArray());
        $record = Adcloud_Response::fromJson($json);
        $this->assertTrue($record instanceof Adcloud_Response_Collection);
    }

    public function testErrorFromArray()
    {
        $array = $this->getErrorArray();
        $record = Adcloud_Response::fromArray($array);
        $this->assertTrue($record instanceof Adcloud_Response_Error);
    }

    public function testRecordFromArray()
    {
        $array = $this->getRecordArray();
        $record = Adcloud_Response::fromArray($array);
        $this->assertTrue($record instanceof Adcloud_Response_Record);
    }

    public function testCollectionFromArray()
    {
        $array = $this->getCollectionArray();
        $record = Adcloud_Response::fromArray($array);
        $this->assertTrue($record instanceof Adcloud_Response_Collection);
    }

    public function testExceptionIfResultIsMissingInErrorFromArray()
    {
        $array = $this->getErrorArray();
        unset($array['result']);

        $this->setExpectedException('InvalidArgumentException');
        Adcloud_Response::fromArray($array);
    }

    public function testExceptionIfResultIsMissingInRecordFromArray()
    {
        $array = $this->getRecordArray();
        unset($array['result']);

        $this->setExpectedException('InvalidArgumentException');
        Adcloud_Response::fromArray($array);
    }

    public function testExceptionIfResultIsMissingInCollectionFromArray()
    {
        $array = $this->getCollectionArray();
        unset($array['result']);

        $this->setExpectedException('InvalidArgumentException');
        Adcloud_Response::fromArray($array);
    }

    public function testExceptionIfStatusIsMissingInErrorFromArray()
    {
        $array = $this->getErrorArray();
        unset($array['status']);

        $this->setExpectedException('InvalidArgumentException');
        Adcloud_Response::fromArray($array);
    }

    public function testExceptionIfStatusIsMissingInRecordFromArray()
    {
        $array = $this->getRecordArray();
        unset($array['status']);

        $this->setExpectedException('InvalidArgumentException');
        Adcloud_Response::fromArray($array);
    }

    public function testExceptionIfStatusIsMissingInCollectionFromArray()
    {
        $array = $this->getCollectionArray();
        unset($array['status']);

        $this->setExpectedException('InvalidArgumentException');
        Adcloud_Response::fromArray($array);
    }
}
