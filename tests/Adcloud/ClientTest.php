<?php 

class Adcloud_ClientTest extends PHPUnit_Framework_TestCase
{
    /**
     * @returns Adcloud_Client
     */
    private function getClient()
    {
        return new Adcloud_Client('code', 'secret');
    }

    /**
     * @param Adcloud_Client $client
     * @return Adcloud_Backend
     */
    private function getMockBackend(Adcloud_Client $client = null)
    {
        $backend = $this->getMock('Adcloud_Backend');

        if ($client !== null) {
            $client->setBackend($backend);
        }

        return $backend;
    }

    public function testChangeBackend()
    {
        $client = $this->getClient();

        $firstBackend = $this->getMockBackend();
        $secondBackend = $this->getMockBackend();

        $client->setBackend($firstBackend);
        $this->assertTrue($firstBackend === $client->getBackend());

        $client->setBackend($secondBackend);
        $this->assertTrue($secondBackend === $client->getBackend());
    }

    public function testIsAuthorizedCallsBackend()
    {
        $client = $this->getClient();
        $backend = $this->getMockBackend($client);

        $backend->expects($this->once())
            ->method('isAuthorized');
       
        $client->isAuthorized();
    }

    public function testAuthorizeCallsBackend()
    {
        $client = $this->getClient();
        $backend = $this->getMockBackend($client);

        $backend->expects($this->once())
            ->method('authorize');
       
        $client->authorize();
    }

    public function testExecuteCallsBackend()
    {
        $client = $this->getClient();
        $backend = $this->getMockBackend($client);
        $request = new Adcloud_Request('foo', $client); 

        $backend->expects($this->once())
            ->method('execute')
            ->with($this->equalTo($request))
            ->will($this->returnValue('foo'));
       
        $response = $client->execute($request);
        $this->assertEquals('foo', $response);
    }

    public function testAuthorizeReturnsThis()
    {
        $client = $this->getClient();
        $backend = $this->getMockBackend($client);
        
        $this->assertTrue($client === $client->authorize());
    }

    public function testDefaultBackend()
    {
        $client = $this->getClient();
        $backend = $client->getBackend();

        $this->assertTrue($backend instanceof Adcloud_Backend_Curl);
    }

    public function testRequestCreatesNewRequestObject()
    {
        $client = $this->getClient();
        $request = $client->request('foo');

        $this->assertTrue($request instanceof Adcloud_Request);
    }

    public function testDefaultRequestClass()
    {
        $client = $this->getClient();
        $request = $client->request('foo');

        $this->assertTrue($request instanceof Adcloud_Request);
    }
}
