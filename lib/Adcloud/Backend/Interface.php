<?php

interface Adcloud_Backend_Interface
{
    /**
     * @param string $code
     * @param string $secret
     * @return Adcloud_Backend_Interface
     */
    public function authorize($code, $secret);

    /**
     * @return boolean
     */
    public function isAuthorized();

    /**
     * @param Adcloud_Request $request
     * @return Adcloud_Response_Interface
     */
    public function execute(Adcloud_Request $request);
}
