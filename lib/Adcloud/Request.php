<?php

/**
 * This objects collects all the informations about the upcoming request
 * from the user. If the request should be executed, this whole object
 * is passed to the backend.
 *
 * @copyright  Copyright (c) 2011 Adcloud GmbH (http://www.adcloud.com)
 * @license    see LICENSE file in project root
 */
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
     * @var Adcloud_Backend_Interface
     */
    private $backend;

    /**
     * @param string $entity
     * @param Adcloud_Backend_Interface $backend
     */
    public function __construct($entity, Adcloud_Backend_Interface $backend)
    {
        $this->entity = $entity;
        $this->backend = $backend;
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
     * @return Adcloud_Request
     */
    public function clearFilter()
    {
        $this->filter = array();
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
        return $this->backend->execute($this);
    }
}
