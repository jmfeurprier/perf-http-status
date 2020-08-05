perf HTTP status
================

Allows to interact with HTTP status strings to be injected into HTTP headers.

## Installation

```shell script
composer require perf/http-status
```

## Usage

### Concrete calls

```php
<?php

use perf\HttpStatus\Http11StatusRepository;

$repository = new Http11StatusRepository();

$httpStatus = $repository->get(404);

echo $httpStatus->getReason(); // Will print "Not Found"
echo $httpStatus->toHeader(); //  Will print "HTTP/1.1 404 Not Found"
```

### Static calls

```php
<?php

use perf\HttpStatus\Http11StatusRepository;

$httpStatus = Http11StatusRepository::create()->get(404);

echo $httpStatus->getReason(); // Will print "Not Found"
echo $httpStatus->toHeader(); //  Will print "HTTP/1.1 404 Not Found"
```
