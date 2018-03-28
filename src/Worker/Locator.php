<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker;

use Neighborhoods\Kojo\Data\Job;
use Neighborhoods\Toolkit\Data\Property\Strict;

class Locator implements LocatorInterface
{
    use Job\AwareTrait;
    use Strict\AwareTrait;

    public function getCallable(): callable
    {
        $class = $this->_getJob()->getWorkerUri();
        $object = new $class;

        return [$object, $this->_getJob()->getWorkerMethod()];
    }
}