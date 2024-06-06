<?php

namespace ArtisanBuild\Llm\Drivers;

use ArtisanBuild\Llm\Traits\HasLifecycleHooks;
use GuzzleHttp\Client;
use OpenAI;
use OpenAI\Contracts\ResponseContract;

class OpenRouterDriver
{
    use HasLifecycleHooks;

    protected ?string $token = null;

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
        $this->token ??= config('openai.api_key');

        return OpenAI::factory()
            ->withApiKey($this->token)
            ->withBaseUri('https://openrouter.ai/api/v1')
            ->withHttpClient(new Client(['timeout' => config('openai.request_timeout', 30)]))
            ->make();
    }

    public function token(string $token): static
    {
        $this->token = $token;

        return $this;
    }

}
