<?php

interface Adcloud_Response_Interface
{
    /**
     * @return mixed
     */
    public function getResult();

    /**
     * @return int
     */
    public function getStatusCode();
}
