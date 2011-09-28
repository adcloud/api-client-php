<?php 

class TestBackend extends Adcloud_Backend_Curl
{
    /**
     * @var array
     */
    public $curlHandles = array();

    /**
     * @var array
     */
    private $responses = array();
   
    /**
     * @param string $file
     * @return TestBackend
     */
    public function loadResponse($file)
    {
        $fullFile = dirname(__FILE__) . '/_files/' . $file;
        if (!file_exists($fullFile)) {
            throw new InvalidArgumentException(
                'There is no request fixture named >' . $file . '<'
            );
        }

        $this->responses[] = json_decode(file_get_contents($fullFile), true); 
        return $this;
    }

    /**
     * 
     */
    public function __destruct()
    {
        if (!empty($this->responses)) {
            throw new RuntimeException(
                'Pending responses that are not fetched'
            );
        }
    }

    /**
     * @param resource $curl
     * @return string
     */
    protected function curlExec($curl)
    {
        $this->curlHandles[] = $curl;
        return array_shift($this->responses);
    }
}

/**
 * @covers Adcloud_Backend_Curl
 */
class Adcloud_Backend_CurlTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return Adcloud_Backend_Curl
     */
    private function getBackend()
    {
        return new TestBackend('test-dont-need-a-valid-host');
    }

    public function setUp()
    {
        if (!extension_loaded('curl')) {
            $this->markTestSkipped(
                'cURL is not installed, marking all Backend_Curl tests skipped.'
            );
        }

        parent::setUp();
    }

    public function testAuthorizeWithRealApi()
    {
        $client = new Adcloud_Backend_Curl();
        $this->setExpectedException('RuntimeException');
        $client->authorize('invalid-code', 'invalid-secret');
    }

    public function testImplementsBackendInterface()
    {
        $interfaces = class_implements($this->getBackend());
        $this->assertContains('Adcloud_Backend_Interface', $interfaces);
    }

    public function testIsAuthorizesDefaultsToFalse()
    {
        $backend = $this->getBackend();
        $this->assertFalse($backend->isAuthorized());
    }

    public function testIsAuthorizedIsTrueAfterAuthorization()
    {
        $backend = $this->getBackend();
        $backend->loadResponse('authorize_valid');
        $authorizeResult = $backend->authorize('code', 'secret');

        $this->assertTrue($backend->isAuthorized());
    }

    public function testAuthorizeReturnsOwnInstance()
    {
        $backend = $this->getBackend();
        $backend->loadResponse('authorize_valid');

        $authorizeResult = $backend->authorize('code', 'secret');
        $this->assertTrue($backend === $authorizeResult);
    }

    public function testAuthrorizeThrowsExceptionOnInvalidCredentials()
    {
        $backend = $this->getBackend();
        $backend->loadResponse('authorize_invalid');

        $this->setExpectedException('RuntimeException');
        $backend->authorize('code', 'secret');
    }

    public function testAuthrorizeThrowsExceptionOnUnknownResponse()
    {
        $backend = $this->getBackend();
        $backend->loadResponse('authorize_unknown');

        $this->setExpectedException('RuntimeException');
        $backend->authorize('code', 'secret');
    }

    public function testAuthrorizeThrowsExceptionEmptyResponse()
    {
        $backend = $this->getBackend();
        $backend->loadResponse('authorize_empty');

        $this->setExpectedException('RuntimeException');
        $backend->authorize('code', 'secret');
    }
}
