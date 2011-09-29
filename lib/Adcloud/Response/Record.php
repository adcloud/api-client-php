<?php

/**
 * A single record that is returned from the server.
 *
 * @copyright  Copyright (c) 2011 Adcloud GmbH (http://www.adcloud.com)
 * @license    see LICENSE file in project root
 */
class Adcloud_Response_Record implements Adcloud_Response_Interface
{
    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var mixed
     */
    private $result;

    /**
     * @param int $statusCode
     * @param mixed $result
     */
    public function __construct($statusCode, $result)
    {
        $this->setStatusCode($statusCode);
        $this->setResult($result);
    }

    /**
     * @param mixed $result
     * @return Adcloud_Response_Record
     */
    protected function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param int $statusCode
     * @return Adcloud_Response_Record
     */
    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
