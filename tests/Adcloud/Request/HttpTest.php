<?php

class Adcloud_Request_HttpTest extends PHPUnit_Framework_TestCase
{
    private function getMockClient()
    {
        return $this->getMock(
            "Adcloud_Client",
            array(),
            array('code', 'secret')
        );
    }

    private function getRequest(Adcloud_Client $client = null)
    {
        if ($client === null) {
            $client = $this->getMockClient();
        }

        return new Adcloud_Request_Http('foo', $client);
    }

    public function testImplementsRequestInterface()
    {
        $request = $this->getRequest();
        $interface = "Adcloud_Request";

        $this->assertContains($interface, class_implements($request));
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


