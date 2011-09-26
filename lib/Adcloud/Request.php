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
     * @var array
     */
    private $filter = array();

    /**
     * @var string
     */
    private $entity;

    /**
     * @var Adcloud_Client
     */
    private $client;

    /**
     * @param string $entity
     * @param Adcloud_Client $client
     */
    public function __construct($entity, Adcloud_Client $client)
    {
        $this->entity = $entity;
        $this->client = $client;
    }

    /**
     * @return array
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return Adcloud_Request
     */
    public function addFilter($key, $value)
    {
        $this->filter[$key] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getEntity()
    {
        return $this->entity;
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
