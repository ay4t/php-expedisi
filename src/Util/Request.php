<?php

namespace Ay4t\PHPExpedisi\Util;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\RequestException;

class Request
{

    const METHOD_GET    = 'GET';

    const METHOD_POST   = 'POST';

    /**
     * berisi data array untuk RequestOptions Guzzle Http Client
     * properti ini dapat di set melalui function setOptions()
     */
    protected $options;

    /**
     * @var string $output (default: 'json' | 'array')
     */
    protected $output = 'json';

    /**
     * @var string $queryType (default: 'query' | 'form_params')
     */
    protected $queryType = 'query';

    /**
    * __construct
    *
    * @return parent::__construct()
    */
    public function __construct()
    {
        
        $this->setOptions([
            RequestOptions::HEADERS => [
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json'
            ]
        ]);
    }


    /**
     * @param string $method = 'GET'
     * @param string $endpoint = null
     * @param array $data = []
     * @param array $query = []
     * 
     * @return array
     */
    public function request(string $method = self::METHOD_GET, string $url = null, array $data = []): object
    {

        if( $this->queryType == 'query' ){
            $this->options[RequestOptions::QUERY] = $data;
        } else if ( $this->queryType == 'form_params' ){
            $this->options[RequestOptions::FORM_PARAMS] = $data;
        }
        
        try {
            
            $guzzleClient = new Client();
            $response  = $guzzleClient->request($method, $url, $this->options);
            return json_decode($response->getBody()->getContents());
            
        } catch (RequestException $requestException) {
            if ($requestException->hasResponse()) {
                return json_decode($requestException->getResponse()->getBody()->getContents());
            }
            
            return json_decode($requestException->getMessage());
        }
    }


    // setOptions
    public function setOptions(array $options = [])
    {
        $this->options = $options;
    }

	/**
	 * 
	 * @param string $output 
	 * @return self
	 */
	public function setOutput($output): self {
		$this->output = $output;
		return $this;
	}

	/**
	 * 
	 * @param string $queryType 
	 * @return self
	 */
	public function setQueryType($queryType): self {
		$this->queryType = $queryType;
		return $this;
	}
}
