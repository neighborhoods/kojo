<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Example\Worker\Delegate;

use Neighborhoods\Kojo\Example\Worker\DelegateInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): DelegateInterface
    {
        $workerDelegate = $this->_getWorkerDelegateClone();

        return $workerDelegate;
    }
}