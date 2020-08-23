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

use perf\HttpStatus\HttpStatusRepository;

$repository = HttpStatusRepository::createDefault();

$httpStatus = $repository->get(404);

echo $httpStatus->getReason(); // Will print "Not Found"
echo $httpStatus->toHeader(); //  Will print "HTTP/1.1 404 Not Found"
```

### Static calls

```php
<?php

use perf\HttpStatus\HttpStatusRepository;

$httpStatus = HttpStatusRepository::createDefault()->get(404);

echo $httpStatus->getReason(); // Will print "Not Found"
echo $httpStatus->toHeader(); //  Will print "HTTP/1.1 404 Not Found"
```
