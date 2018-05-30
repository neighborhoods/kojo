# Example Protean Compliant Kōjō DLC Pattern

SQS Queue Name: `local-bwilson`

`scratch/worker-facade.php`
```php
<?php
declare(strict_types=1);

use Neighborhoods\KojoExample\V1\Worker\Facade;

ini_set('assert.exception', '1');
error_reporting(E_ALL);
require_once __DIR__ . '/../example/vendor/autoload.php';

try {
    $workerFacade = new Facade();
    $workerFacade->start();
} catch (\Throwable $throwable) {
    echo $throwable->getMessage();
}

return;
```