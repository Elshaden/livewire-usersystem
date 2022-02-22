# Livewire User management System

[![Latest Version on Packagist](https://img.shields.io/packagist/v/elshaden/livewire-usersystem.svg?style=flat-square)](https://packagist.org/packages/elshaden/livewire-usersystem)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/elshaden/livewire-usersystem/run-tests?label=tests)](https://github.com/elshaden/livewire-usersystem/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/elshaden/livewire-usersystem/Check%20&%20fix%20styling?label=code%20style)](https://github.com/elshaden/livewire-usersystem/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/elshaden/livewire-usersystem.svg?style=flat-square)](https://packagist.org/packages/elshaden/livewire-usersystem)

## This Work In Progress Repo, Please Do Not Use Until Complete


## Installation

You can install the package via composer:

```bash
composer require elshaden/livewire-usersystem
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="livewire-usersystem-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="livewire-usersystem-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="livewire-usersystem-views"
```

## Usage


## Testing

```bash
composer test
```

## Credits

- [Salah Elabbar](https://github.com/Elshaden)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
