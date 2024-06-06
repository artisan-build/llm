<?php

namespace ArtisanBuild\Llm\Facades;

use ArtisanBuild\Llm\Drivers\AzureDriver;
use ArtisanBuild\Llm\Drivers\OpenAIDriver;
use Illuminate\Support\Facades\Facade;

class Azure extends Facade
{
    public static function getFacadeAccessor()
    {
        return AzureDriver::class;
    }
}
