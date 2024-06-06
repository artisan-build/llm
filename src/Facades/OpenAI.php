<?php

namespace ArtisanBuild\Llm\Facades;

use ArtisanBuild\Llm\OpenAI\OpenAIDriver;
use Illuminate\Support\Facades\Facade;

class OpenAI extends Facade
{
    public static function getFacadeAccessor()
    {
        return OpenAIDriver::class;
    }
}
