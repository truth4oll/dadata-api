# Dadata.ru API Client

[Dadata.ru](http://dadata.ru) API client based on HTTP Client Extension for Yii 2.

## How to use

Add this code into your project. Use yours `token` and `secret` provided by [dadata.ru](http://dadata.ru)

```php
$client = new DadataClient(
    [
        'token' => token,
        'secret' => secret,
    ]
);
```

Now client is ready to use.

### Data clean


```php
$response = $client->cleanAddress('< address >');
```

## Installing

This project can be installed using Composer. Add the following to your
composer.json:

```javascript

{
    "require": {
        "truth4oll/dadata-api": "dev-master"
    }
}
```

## Links

- [Dadata Client](https://github.com/moriony/dadata-client/tree/master)
- [Dadata.ru API documantation](https://dadata.ru/api/)
