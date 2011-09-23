<?php

class Adcloud_Request_Http implements Adcloud_Request
{
    /**
     * @param string $method
     * @param Adcloud_Client $client
     */
    public function __construct($method, Adcloud_Client $client)
    {
        $this->method = $method;
        $this->client = $client;
    }

    /**
     * @return Adcloud_Response
     */
    public function getResponse()
    {
        return $this->client->execute($this);
    }
}
