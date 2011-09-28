<?php 

/**
 * @covers Adcloud_Backend_Curl
 */
class Adcloud_Backend_CurlTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return Adcloud_Backend_Curl
     */
    public function getBackend()
    {
        return new Adcloud_Backend_Curl('http://api.local');
    }

    public function testImplementsBackendInterface()
    {
        $interfaces = class_implements($this->getBackend());
        $this->assertContains('Adcloud_Backend_Interface', $interfaces);
    }

    public function test()
    {
        $backend = $this->getBackend();
        
        
    }
}
