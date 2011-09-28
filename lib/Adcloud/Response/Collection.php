<?php

class Adcloud_Response_Collection extends Adcloud_Response_Record 
{
    /**
     * @var array
     */
    private $metadata = array();

    /**
     * @param int $statusCode
     * @param mixed $result
     * @param array $metadata
     */
    public function __construct($statusCode, $result, $metadata)
    {
        parent::__construct($statusCode, $result);
        $this->metadata = $metadata;
    }

    /**
     * @return array
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @param array $result
     * @return Adcloud_Response_Record
     */
    protected function setResult($result)
    {
        if (!is_array($result)) {
            throw new InvalidArgumentException(
                "Collection result must be from type array"
            );
        }
    
        $oldResult = $result;
        $result = array();

        foreach ($oldResult as $record) {
            $result[] = new Adcloud_Response_Record(
                $this->getStatusCode(), $record
            ); 
        }

        return parent::setResult($result);
    }
}
