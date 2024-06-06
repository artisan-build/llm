# A package that wraps several LLM providers for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/artisan-build/llm.svg?style=flat-square)](https://packagist.org/packages/artisan-build/llm)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/artisan-build/llm/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/artisan-build/llm/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/artisan-build/llm/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/artisan-build/llm/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/artisan-build/llm.svg?style=flat-square)](https://packagist.org/packages/artisan-build/llm)

First of all, I want to acknowledge the amazing work that Nuno and Sandro have done managing the openai-php projects
including the Laravel wrapper that this package replaces for us. We wrote this package to meet a few specific needs:

1. We need to allow users to bring their own keys and the way the client is created in the openai-php/laravel package makes that impossible.
2. We wanted to add hooks before the request is made and after the response is received.
3. We wanted to simplify the use of Azure and OpenRouter.ai

If none of those apply to you, then the openai-php/laravel package is a great choice, and you'll get no additional 
benefit from using this instead.

## Support us

You can support our open-source work by sponsoring [Len Woodward](https://github.com/sponsors/ProjektGopher). Since 
Ed lives in Europe where taxes are a bit more complicated, he doesn't participate in the sponsorship program, but you
are welcome to buy him a beer if you see him at a conference.

## Installation

You can install the package via composer:

```bash
composer require artisan-build/llm
```


You can publish the config file with:

```bash
php artisan vendor:publish --tag="llm-config"
```

This is the contents of the published config file:

```php
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
    'openrouter' => [
        'api_key' => env('OPEN_ROUTER_API_KEY'),
    ],
    'request_timeout' => env('OPENAI_REQUEST_TIMEOUT', 30),
]
```


## Usage

For the full documentation, please visit [our documentation site](https://artisan.build/docs/llm)

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ed Grosvenor](https://github.com/edgrosvenor)
- [Len Woodward](https://github.com/projektgopher)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
