API-Problem
===========

A PHP library to describe API problems according to [RFC 7870](https://tools.ietf.org/html/rfc7807).

## Installation

```bash
composer require abc/api-problem
```

## Usage

```php
use Abc\ApiProblem;

$apiProblem = new ApiProblem(
    'http://domain.tld/problem/resource-not-found'),
    'Resource Not Found',
    404,
    sprintf('Resource with id "%s" not found', $id),
    $requestUri
);

$json = $apiProblem->toJson();
```

## License

The MIT License (MIT). Please see [License File](./LICENSE) for more information.
