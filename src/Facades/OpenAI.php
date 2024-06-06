<?php

namespace ArtisanBuild\Llm\Facades;

use ArtisanBuild\Llm\Drivers\OpenAIDriver;
use Illuminate\Support\Facades\Facade;

class OpenAI extends Facade
{
    public static function getFacadeAccessor()
    {
        return OpenAIDriver::class;
    }
}
