<?php

namespace Ay4t\PHPExpedisi\Provider;
use Ay4t\PHPExpedisi\Interfaces\ProviderInterface;

/**
 * class ini berisi properti dan method yang akan selalu ada dan digunakan dalam class providers
 */
abstract class AbstractProvider implements ProviderInterface
{
    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $secretKey;

    /**
     * @var string
     */
    protected $baseUrl;

    protected $result;


    /**
     * @var string $queryType (default: 'query' | 'form_params')
     */
    protected $queryType = 'query';


    public function request(string $endpoint, string $method, array $params = [])
    {
        $url    = $this->getBaseUrl() . $endpoint;
        
        $request = new \Ay4t\PHPExpedisi\Util\Request();
        $request->setOptions([
            \GuzzleHttp\RequestOptions::HEADERS => [
                'key' => $this->apiKey
            ]
        ]);
        $request->setQueryType($this->queryType);
        $response =  $request->request( $method, $url, $params);

        $this->result = $response;
        return $response;
    }

	/**
	 * 
	 * @return string
	 */
	public function getApiKey() 
    {
		return $this->apiKey;
	}
	
	/**
	 * 
	 * @param string $apiKey 
	 * @return self
	 */
	public function setApiKey($apiKey): self 
    {
		$this->apiKey = $apiKey;
		return $this;
	}

	/**
	 * 
	 * @return string
	 */
	public function getSecretKey() 
    {
		return $this->secretKey;
	}
	
	/**
	 * 
	 * @param string $secretKey 
	 * @return self
	 */
	public function setSecretKey($secretKey): self 
    {
		$this->secretKey = $secretKey;
		return $this;
	}

	/**
	 * 
	 * @return string
	 */
	public function getBaseUrl() {
		return $this->baseUrl;
	}
	
	/**
	 * 
	 * @param string $baseUrl 
	 * @return self
	 */
	public function setBaseUrl($baseUrl): self {
		$this->baseUrl = $baseUrl;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getResult() {
		return $this->result;
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
