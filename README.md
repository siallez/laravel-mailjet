# Mailjet for Laravel
This package integrates the [Mailjet API Client](https://github.com/mailjet/mailjet-apiv3-php) in Laravel.
You can access the API through Laravel service container or sending mails in Laravel's way with the new driver.

## Install
> This package requires version 5.1 of Laravel framework. I can't ensure the compatibility with older versions.

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

If you want to use the driver you should also add this:
```
MAIL_DRIVER=mailjet
```

## Usage
You can access the API with dependency injection or all other available methods to resolve the [Service Container](http://laravel.com/docs/5.1/container#resolving). If you want to learn how to use it you can go to the official [Mailjet repository](https://github.com/mailjet/mailjet-apiv3-php).

Example:
``` php
Route::get('/mailjet', function(\Mailjet\Client $mj) {
    $response = $mj->get(\Mailjet\Resources::$Contact);
    if ($response->success()) {
        $contact = $response->getData();
        return dd($contact);
    }

    return dd($response);
});
```

Using the driver is as easy as setting `mailjet` as the mail driver (look at Setup). After that, you can use the regular Laravel's Mail facade and all mails will be sent with mailjet. You can find all the information about that [here](http://laravel.com/docs/5.1/mail).

Example:
``` php
Route::get('/mailjet2', function() {
    $mail = Mail::raw('Text to e-mail', function ($message) {
        $message->from('from@email.com')->to('to@email.com')->subject('Testing mailjet');
    });
    
    return dd($mail);
});
```

