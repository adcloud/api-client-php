<?php

/**
 * @covers Adcloud_Request
 */
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

    public function testSetAndGetPage()
    {
        $request = $this->getRequest();
        
        $this->assertTrue($request === $request->setPage(42));
        $this->assertEquals(42, $request->getPage());
    }
    
    public function testSetPageCastsToInt()
    {
        $request = $this->getRequest();

        $this->assertTrue($request === $request->setPage('42'));
        $this->assertEquals(42, $request->getPage());
    }

    public function testDefaultPage()
    {
        $this->assertEquals(1, $this->getRequest()->getPage());
    }

    public function testSetAndGetPerPage()
    {
        $request = $this->getRequest();
        
        $this->assertTrue($request === $request->setPerPage(42));
        $this->assertEquals(42, $request->getPerPage());
    }
    
    public function testSetPerPageCastsToInt()
    {
        $request = $this->getRequest();

        $this->assertTrue($request === $request->setPerPage('42'));
        $this->assertEquals(42, $request->getPerPage());
    }

    public function testDefaultPerPage()
    {
        $this->assertEquals(50, $this->getRequest()->getPerPage());
    }

    public function testEntiySetViaConstructorAndOwnGetter()
    {
        $client = $this->getMockClient();
        $request = new Adcloud_Request('foo/bar', $client);

        $this->assertEquals('foo/bar', $request->getEntity());
    }
    
    public function testDefaultFilterAreEmpty()
    {
        $filter = $this->getRequest()->getFilter();
        $this->assertEmpty($filter);
        $this->assertTrue(is_array($filter));
    }

    public function testAddFilter()
    {
        $request = $this->getRequest();
        $filter = array('foo' => 'bar');

        $this->assertTrue($request === $request->addFilter('foo', 'bar'));
        $this->assertEquals($filter, $request->getFilter());
    }

    public function testFilterKeysAreUnique()
    {
        $request = $this->getRequest();
        $filter = array('foo' => 'bar');

        $request->addFilter('foo', 42)
            ->addFilter('foo', 'bar');
        $this->assertEquals($filter, $request->getFilter());
    }
}


