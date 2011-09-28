<?php

/**
 * @covers Adcloud_Request
 */
class Adcloud_RequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return Adcloud_Backend_Interface
     */
    private function getMockBackend()
    {
        return $this->getMock('Adcloud_Backend_Curl');
    }

    /**
     * @param Adcloud_Backend_Interface $backend
     * @return Adcloud_Request
     */
    private function getRequest(Adcloud_Backend_Interface $backend = null)
    {
        if ($backend === null) {
            $backend = $this->getMockBackend();
        }

        return new Adcloud_Request('foo', $backend);
    }

    public function testResponseReturnsResultFromBackendExecute()
    {
        $backend = $this->getMockBackend();
        $request = $this->getRequest($backend);

        $backend->expects($this->once())
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
        $backend = $this->getMockBackend();
        $request = new Adcloud_Request('foo/bar', $backend);

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

    public function testClearFilter()
    {
        $request = $this->getRequest();
        $request->addFilter('foo', 'bar');

        $this->assertTrue($request === $request->clearFilter());
        $this->assertEmpty($request->getFilter());
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


