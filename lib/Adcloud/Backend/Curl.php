<?php

class Adcloud_Backend_Curl implements Adcloud_Backend_Interface 
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var boolean
     */
    private $isAuthorized = false;

    /**
     * @param string $host
     */
    public function __construct($host = 'https://api.adcloud.com')
    {
        $this->host = rtrim($host, ' /');
    }

    /**
     * @param string $code
     * @param string $secret
     * @return Adcloud_Backend_Curl
     */
    public function authorize($code, $secret)
    {
        return $this;
    }

    /**
     * @return boolean
     */
    public function isAuthorized()
    {
        return $this->isAuthorized;
    }

    /**
     * @param Adcloud_Request $request
     * @return Adcloud_Response_Interface
     */
    public function execute(Adcloud_Request $request)
    {
        return $this;
    }
}
