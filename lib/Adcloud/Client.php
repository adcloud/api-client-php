<?php

class Adcloud_Client
{
    /**
     * @var Adcloud_Backend_Interface
     */
    private $backend;

    /** 
     * @var string
     */
    private $code;

    /** 
     * @var string
     */
    private $secret;

    /**
     * @param string $code
     * @param string $secret
     */
    public function __construct($code, $secret)
    {
        $this->code = $code;
        $this->secret = $secret;
        $this->setDefaultBackend();
    }

    /**
     * @return Adcloud_Client
     */
    private function setDefaultBackend()
    {
        $this->setBackend(new Adcloud_Backend_Curl());
        return $this;
    }

    /**
     * @param Adcloud_Backend_Interface $backend
     * @return Adcloud_Client
     */
    public function setBackend(Adcloud_Backend_Interface $backend)
    {
        $this->backend = $backend;
        return $this;
    }

    /**
     * @return Adcloud_Backend
     */
    public function getBackend()
    {
        return $this->backend;
    }

    /**
     * @param string $method
     * @return Adcloud_Request
     */
    public function request($method)
    {
        if (!$this->backend->isAuthorized()) {
            $this->backend->authorize($this->code, $this->secret);
        }

        // TODO: Throw Exception if not authorized here
        return new Adcloud_Request($method, $this->backend);
    }
}
