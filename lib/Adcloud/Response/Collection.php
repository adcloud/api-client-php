<?php

class Adcloud_Response_Collection extends Adcloud_Response_Record 
{
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

        return parent::setResult($result);
    }
}
