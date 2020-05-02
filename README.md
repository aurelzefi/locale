# Locale

A package to easily add localization to your Laravel project.

## Requirements

- PHP 7.4 or higher
- Laravel 7.0 or higher

## Installation

Clone this repo, add the package to your repositories and then require it:

```bash
git clone git@github.com:aurelzefi/locale.git
```

```json
"repositories": [
    {
        "type": "path",
        "url": "./../locale"
    }
]
```

```bash
composer require aurelzefi/locale
```

## Usage

### Publish The Config File

In this file you should define the list of locales supported by your application.

```bash
php artisan vendor:publish --tag=locale-config
```

Add the `{locale}` prefix to your localized routes and the middleware:

```php
use Aurel\Locale\Http\Middleware\SetLocale;

Route::prefix('{locale?}')
    ->middleware('web', SetLocale::class)
    ->namespace($this->namespace)
    ->group(base_path('routes/web.php'));
```

Now all the routes in the defined group will be localized based on your configuration.
