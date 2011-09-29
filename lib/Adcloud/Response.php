<?php

class Adcloud_Response
{
    /**
     * @param array $array
     * @return integer
     */
    private static function getStatus(array $array)
    {
        if (!array_key_exists('status', $array)) {
            throw new InvalidArgumentException(
                'Field >status< in reponse missing'
            );
        }
        return $array['status'];
    }

    /**
     * @param array $array
     * @return mixed
     */
    private static function getResult(array $array)
    {
        if (!array_key_exists('result', $array)) {
            throw new InvalidArgumentException(
                'Field >result< in reponse missing'
            );
        }
        return $array['result'];
    }
   
    /**
     * @param array $array
     * @return bool
     */
    private static function isErrorResponse(array $array)
    {
        return array_key_exists('errors', $array);
    }

    /**
     * @param array $array
     * @return bool
     */
    private static function isCollectionResponse(array $array)
    {
        return array_key_exists('collection', $array);
    }

    /**
     * @param array $array
     * @return Adcloud_Response_Interface
     */
    public static function fromArray(array $array)
    {
        $status = self::getStatus($array);
        if (self::isErrorResponse($array)) {
            return new Adcloud_Response_Error($status, $array['errors']);
        }

        $result = self::getResult($array);
        if (self::isCollectionResponse($array)) {
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
