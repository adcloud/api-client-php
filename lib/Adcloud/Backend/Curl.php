<?php

class Adcloud_Backend_Curl implements Adcloud_Backend_Interface 
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string 
     */
    private $accessToken;

    /**
     * @param string $host
     */
    public function __construct($host = 'https://api.adcloud.com')
    {
        $this->host = rtrim($host, ' /');
    }

    /**
     * @param resource $curl
     * @return string
     */
    protected function curlExec($curl)
    {
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response, true);
    }

    /**
     * @param string $mode
     * @param string $path
     * @param array $params
     * @return resource
     */
    private function curlInit($mode, $path, array $params = array())
    {
        $mode = trim(strtoupper($mode));
        $url = $this->host . '/v1/' . ltrim($path, '/');
        $curl = curl_init();
        
        if ($mode == 'GET') {
            $url .= '?' . http_build_query($params);
            curl_setopt($curl, CURLOPT_HTTPGET, true);
        }
        if ($mode == 'POST') {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        }

        curl_setopt($curl, CURLOPT_URL, $url);        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        return $curl;
    }

    /**
     * @param string $code
     * @param string $secret
     * @return Adcloud_Backend_Curl
     */
    public function authorize($code, $secret)
    {
        $params = array(
            'client_id' => $code, 
            'client_secret' => $secret, 
            'grant_type' => 'none'
        );
        $curl = $this->curlInit('POST', '/oauth/access_token', $params);

        $response = $this->curlExec($curl);
        $this->validateAuthorizesResponse($response);

        $this->accessToken = $response['access_token'];
        return $this;
    }

    /**
     * @param array $response
     * @return Adcloud_Backend_Curl
     */
    private function validateAuthorizesResponse($response)
    {
        if (empty($response)) {
            throw new RuntimeException(
                'Authorization Error: Empty response fetched'
            );
        }

        if (array_key_exists('error', $response)) {
            throw new RuntimeException(
                'Authorization Error: ' . $response['error_description']
            );
        }

        if (!array_key_exists('access_token', $response)) {
            throw new RuntimeException(
                'Authorization Error: Invalid response fetched'
            );
        }

        return $this;
    }

    /**
     * @return boolean
     */
    public function isAuthorized()
    {
        return !empty($this->accessToken);
    }

    /**
     * @param Adcloud_Request $request
     * @return Adcloud_Response_Interface
     */
    public function execute(Adcloud_Request $request)
    {
        $params = array(
            'access_token' => $this->accessToken,
            'filter' => $request->getFilter(),
            'per_page' => $request->getPerPage(),
            'page' => $request->getPage()
        );
        $url = '/' . trim($request->getEntity(), ' /');

        $curl = $this->curlInit('GET', $url, $params);
        $response = $this->curlExec($curl);

        return Adcloud_Response::fromArray($response); 
    }
}
