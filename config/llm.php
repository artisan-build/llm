<?php

return [
    'azure' => [
        'deployment_id' => env('AZURE_DEPLOYMENT_ID'),
        'resource_id' => env('AZURE_RESOURCE_ID'),
        'version' => env('AZURE_VERSION'),
    ],
    'openai' => [
        'api_key' => env('OPENAI_API_KEY'),
        'organization' => env('OPENAI_ORGANIZATION'),
    ],
    'open_router' => [
        'api_key' => env('OPEN_ROUTER_API_KEY'),
    ],
    'request_timeout' => env('OPENAI_REQUEST_TIMEOUT', 30),
];
