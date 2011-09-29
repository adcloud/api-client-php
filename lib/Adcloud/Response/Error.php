<?php

/**
 * Response object for all errors that occurs on the server.
 *
 * @copyright  Copyright (c) 2011 Adcloud GmbH (http://www.adcloud.com)
 * @license    see LICENSE file in project root
 */
class Adcloud_Response_Error extends Adcloud_Response_Record
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
