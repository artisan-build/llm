<?php

namespace ArtisanBuild\Llm\Facades;

use ArtisanBuild\Llm\Drivers\AzureDriver;
use ArtisanBuild\Llm\Drivers\OpenAIDriver;
use ArtisanBuild\Llm\Drivers\OpenRouterDriver;
use Illuminate\Support\Facades\Facade;

class OpenRouter extends Facade
{
    public static function getFacadeAccessor()
    {
        return OpenRouterDriver::class;
    }
}
