<?php

namespace Ay4t\PHPExpedisi\Interfaces;

interface ProviderInterface
{
    // getApiKey
    public function getApiKey();

    // setApiKey
    public function setApiKey(string $apiKey);

    // getSecretKey
    public function getSecretKey();

    // setSecretKey
    public function setSecretKey(string $secretKey);

    // getBaseUrl
    public function getBaseUrl();

    // setBaseUrl
    public function setBaseUrl(string $baseUrl);

    // request
    public function request(string $endpoint, string $method, array $params = []);

    // setQueryType
    public function setQueryType(string $queryType);

    // getResult
    public function getResult();
}
