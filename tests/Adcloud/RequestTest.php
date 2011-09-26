<?php

class Adcloud_RequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return Adcloud_Client
     */
    private function getMockClient()
    {
        return $this->getMock(
            "Adcloud_Client",
            array(),
            array('code', 'secret')
        );
    }

    /**
     * @param Adcloud_Client $client
     * @return Adcloud_Request
     */
    private function getRequest(Adcloud_Client $client = null)
    {
        if ($client === null) {
            $client = $this->getMockClient();
        }

        return new Adcloud_Request('foo', $client);
    }

    public function testResponseReturnsResultFromBackendExecute()
    {
        $client = $this->getMockClient();
        $request = $this->getRequest($client);

        $client->expects($this->once())
            ->method('execute')
            ->with($this->equalTo($request))
            ->will($this->returnValue('foo'));

        $response = $request->getResponse();
        $this->assertEquals('foo', $response);
    }
}


