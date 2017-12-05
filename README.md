# nhds/jobs
A distributed job system.

Example usage:
```php
<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use \NHDS\Jobs\Container;

$jobsContainer = new Container();
$server = $jobsContainer->getContainerBuilder()->get('server');

$server->start();
```

**OR**

Anything that is good is from sitting on the shoulder of one giant or another.  Anything that is bad is mine, the only comfort I have to offer is the following from yet another giant:

* https://xkcd.com/1513/
* https://xkcd.com/1695/
* https://xkcd.com/1833/