<?php 

/**
 * @covers Adcloud_Client
 */
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
     * @return Adcloud_Backend_Interface
     */
    private function getMockBackend(Adcloud_Client $client = null)
    {
        $backend = $this->getMock('Adcloud_Backend_Curl');

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

    public function testAuthorizeCallsBackendNotIfAuthorized()
    {
        $client = $this->getClient();
        $backend = $this->getMockBackend($client);

        $backend->expects($this->once())
            ->method('isAuthorized')
            ->will($this->returnValue(true));

        $client->request('foo');
    }

    public function testAuthorizeCallsBackendIfNotAuthorized()
    {
        $client = $this->getClient();
        $backend = $this->getMockBackend($client);

        $backend->expects($this->once())
            ->method('isAuthorized')
            ->will($this->returnValue(false));

        $backend->expects($this->once())
            ->method('authorize');
       
        $client->request('foo');
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

        $backend = $this->getMockBackend($client);
        $backend->expects($this->once())
            ->method('isAuthorized')
            ->will($this->returnValue(true));

        $request = $client->request('foo');
        $this->assertTrue($request instanceof Adcloud_Request);
    }
}
