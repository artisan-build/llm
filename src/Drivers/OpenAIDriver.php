<?php

namespace ArtisanBuild\Llm\Drivers;

use ArtisanBuild\Llm\Traits\HasLifecycleHooks;
use GuzzleHttp\Client;
use OpenAI;
use OpenAI\Contracts\ResponseContract;

class OpenAIDriver
{
    use HasLifecycleHooks;

    protected ?string $token = null;

    protected ?string $organization = null;

    protected ?string $api = null;

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
        $this->payload = $payload;

        $this->runHook('on_before_prompt');

        $this->response = $this->client()->{$this->api}()->create($this->payload);

        $this->runHook('on_after_prompt');

        return $this->response;

    }

    private function client(): OpenAI\Client
    {
        $this->token ??= config('llm.openai.api_key');
        $this->organization ??= config('llm.openai.organization');

        return OpenAI::factory()
            ->withApiKey($this->token)
            ->withOrganization($this->organization)
            ->withHttpHeader('OpenAI-Beta', 'assistants=v2')
            ->withHttpClient(new Client(['timeout' => config('llm.request_timeout', 30)]))
            ->make();
    }

    public function token(string $token): static
    {
        $this->token = $token;

        return $this;
    }

    public function organization(string $organization): static
    {
        $this->organization = null;

        return $this;
    }
}
