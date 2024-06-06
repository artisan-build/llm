<?php

namespace ArtisanBuild\Llm\OpenAI;

use ArtisanBuild\Llm\Traits\HasLifecycleHooks;
use GuzzleHttp\Client;
use OpenAI;

class OpenAIDriver
{
    use HasLifecycleHooks;

    protected ?string $token = null;

    protected ?string $organization = null;

    protected ?string $api = null;

    protected array $payload = [];

    public function chat(): static
    {
        $this->api = 'chat';

        return $this;
    }

    public function create(array $payload)
    {
        $this->payload = $payload;

        $this->runHook('on_before_prompt');

        $response = $this->client()->{$this->api}()->create($payload);

        $this->runHook('on_after_prompt');

        return $response;

    }

    private function client(): OpenAI\Client
    {
        $this->token ??= config('openai.api_key');
        $this->organization ??= config('openai.organization');

        return OpenAI::factory()
            ->withApiKey($this->token)
            ->withOrganization($this->organization)
            ->withHttpHeader('OpenAI-Beta', 'assistants=v2')
            ->withHttpClient(new Client(['timeout' => config('openai.request_timeout', 30)]))
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
