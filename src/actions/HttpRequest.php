<?php

namespace panlatent\craft\actions\actions;

use craft\helpers\Json;
use GuzzleHttp\Client;
use panlatent\craft\actions\base\Action;
use panlatent\craft\actions\base\ContextInterface;
use panlatent\craft\actions\base\OutputInterface;

class HttpRequest extends Action
{
    /**
     * @var string
     */
    public string $method = 'get';

    /**
     * @var string Request URL default is echo api.
     */
    public string $url = 'https://postman-echo.com/get';

    /**
     * @var array
     */
    public array $headers = [];

    /**
     * @var array
     */
    public array $queryParams = [];

    /**
     * @var string
     */
    public string $contentType = '';

    /**
     * @var string
     */
    public string $body = '';


    public function run(ContextInterface $context): OutputInterface
    {
        $client = new Client();

        $response = $client->request($this->method, $this->url, $this->getOptions());
        $statusCode = $response->getStatusCode();

        return new class implements OutputInterface {

        };
    }

    protected function getClient(): Client
    {
        return new Client();
    }

    protected function getOptions(): array
    {
        $options = [];

        if (!in_array($this->method, ['get', 'head']) && !empty($this->body)) {
            switch ($this->contentType) {
                case 'application/json':
                    $options['json'] = Json::decode($this->body);
                    break;
                case 'application/x-www-form-urlencoded':
                    parse_str($this->body, $formParams);
                    $options['form_params'] = $formParams;
                    break;
                default:
                    $options['headers'] = ['content-type' => $this->contentType];
                    $options['body'] = $this->body;
            }
        }

        foreach ($this->headers as ['name' => $name, 'value' => $value, 'enabled' => $enabled]) {
            if ($enabled) {
                $options['headers'][$name] = $value;
            }
        }

        foreach ($this->queryParams as ['name' => $name, 'value' => $value, 'enabled' => $enabled]) {
            if ($enabled) {
                $options['query'][$name] = $value;
            }
        }

        return $options;
    }
}