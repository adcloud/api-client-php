<?php

class Adcloud_Response
{
    /**
     * @param array $array
     * @return Adcloud_Response_Interface
     */
    public static function fromArray(array $array)
    {
        if (!array_key_exists('status', $array)) {
            throw new InvalidArgumentException(
                'Field >status< in reponse missing'
            );
        }
        $status = $array['status'];

        if (array_key_exists('errors', $array)) {
            return new Adcloud_Response_Error(
                $status, $array['errors']
             );
        }

        if (!array_key_exists('result', $array)) {
            throw new InvalidArgumentException(
                'Field >result< in reponse missing'
            );
        }
        $result = $array['result'];

        if (array_key_exists('collection', $array)) {
            return new Adcloud_Response_Collection(
                $status, $result, $array['collection']
            );
        } 

        return new Adcloud_Response_Record($status, $result);
    }

    /**
     * @param string $json
     * @return Adcloud_Response_Interface
     */
    public static function fromJson($json)
    {
        return self::fromArray(json_decode($json, true));
    }
}
