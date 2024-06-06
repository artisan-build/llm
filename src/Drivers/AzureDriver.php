<?php

namespace ArtisanBuild\Llm\Drivers;

use ArtisanBuild\Llm\Traits\HasLifecycleHooks;
use GuzzleHttp\Client;
use OpenAI;
use OpenAI\Contracts\ResponseContract;

class AzureDriver
{
    use HasLifecycleHooks;

    protected ?string $token = null;

    protected ?string $api = null;

    protected ?string $deployment = null;
    protected ?string $version = null;
    protected ?string $resource = null;

    protected array $payload = [];

    // It's bad enough they marked all classes final. Marking contracts internal is painful.
    protected ?ResponseContract $response = null;

    public function __call(string $name, array $arguments = []): static
    {
        if (method_exists(OpenAI\Client::class, $name)) {
            $this->api = $name;
            return $this;
        }
        throw new \RuntimeException("The method {$name} does not exist in the OpenAI client");
    }


    public function create(array $payload)
    {
        unset($payload['model']);

        $this->payload = $payload;

        $this->runHook('on_before_prompt');

        $this->response = $this->client()->{$this->api}()->create($this->payload);

        $this->runHook('on_after_prompt');

        return $this->response;

    }

    private function client(): OpenAI\Client
    {
        $this->token ??= config('azure.api_key');
        $this->resource ??= config('azure.resource_id');
        $this->version ??= config('azure.version');
        $this->deployment ??= config('azure.deployment');

        return OpenAI::factory()
            ->withBaseUri("{$this->resource}.openai.azure.com/openai/deployments/{$this->deployment}")
            ->withHttpHeader('api-key', $this->token)
            ->withQueryParam('api-version', $this->version)
            ->make();
    }

    public function resource(string $resource): static
    {
        $this->resource = $resource;
        return $this;
    }

    public function deployment(string $deployment): static
    {
        $this->deployment = $deployment;
        return $this;
    }

    public function version(string $version): static
    {
        $this->version = $version;
        return $this;
    }

    public function token(string $token): static
    {
        $this->token = $token;

        return $this;
    }
}
