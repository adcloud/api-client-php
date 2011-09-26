<?php

class Adcloud_Request
{
    /**
     * @var int
     */
    private $page = 1;

    /**
     * @var int
     */
    private $perPage = 50;

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
     * @param int $perPage
     * @return Adcloud_Request
     */
    public function setPerPage($perPage)
    {
        $this->perPage = (int) $perPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param int $page
     * @return Adcloud_Request
     */
    public function setPage($page)
    {
        $this->page = (int) $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return Adcloud_Response
     */
    public function getResponse()
    {
        return $this->client->execute($this);
    }
}
