# Mailjet for Laravel
This package integrates the [Mailjet API Client](https://github.com/mailjet/mailjet-apiv3-php) in Laravel.
You can access the API through Laravel service container or sending mails in Laravel's way with the new driver.

## Install
TODO: composer.json

In `config/app.php`, add this to the `providers` array:
```php
Siallez\Mailjet\MailjetServiceProvider::class,
```

## Setup
In order to start using the package you only need to add these environment variables in your `.env` file with your Mailjet keys:
```
MAILJET_APIKEY_PUBLIC=
MAILJET_APIKEY_PRIVATE=
```

## Usage
TODO
