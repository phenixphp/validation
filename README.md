# Phenix validation

[![Latest Version on Packagist](https://img.shields.io/packagist/v/phenixphp/validation.svg?style=flat-square)](https://packagist.org/packages/phenixphp/validation)
[![Tests](https://img.shields.io/github/actions/workflow/status/phenixphp/validation/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/phenixphp/validation/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/phenixphp/validation.svg?style=flat-square)](https://packagist.org/packages/phenixphp/validation)

Phenix framework data validation layer.

## Installation

You can install the package via composer:

```bash
composer require phenixphp/validation
```

## Documentation

The official documentation for Phenix validation can be found on the [Phenix framework website](https://phenix.omarbarbosa.com/).

## Usage

Basic example of validator usage:

```php
use Phenix\Validation\Types\Str;
use Phenix\Validation\Validator;

$validator = new Validator();

$validator->setRules([
    'name' => Str::required()->min(3)->max(10),
    'last_name' => Str::required()->min(3)->max(10),
]);

$validator->setData([
    'name' => 'John',
    'last_name' => 'Doe',
]);

echo $validator->passes() ? 'Data is Ok' : 'Data is invalid';
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security Vulnerabilities

If you discover a security vulnerability within Phenix, please send an e-mail to Omar Barbosa via [contacto@omarbarbosa.com](mailto:contacto@omarbarbosa.com). All security vulnerabilities will be promptly addressed.

## License

The Phenix framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
