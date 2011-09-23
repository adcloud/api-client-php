<?php

class Adcloud_Backend_Curl implements Adcloud_Backend 
{
    /**
     * @param string $code
     * @param string $secret
     */
    public function __construct($code, $secret)
    {
    }

    /**
     * @return Adcloud_Backend_Curl
     */
    public function authorize()
    {
        return $this;
    }

    /**
     * @return boolean
     */
    public function isAuthorized()
    {
        return true;
    }

    /**
     * @param Adcloud_Request $request
     * @return Adcloud_Response
     */
    public function execute(Adcloud_Request $request)
    {
    }
}
