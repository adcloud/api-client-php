<?php

interface Adcloud_Backend
{
    /**
     * @return Adcloud_Backend
     */
    public function authorize();

    /**
     * @return boolean
     */
    public function isAuthorized();

    /**
     * @return Adcloud_Response
     */
    public function execute(Adcloud_Request $request);
}
