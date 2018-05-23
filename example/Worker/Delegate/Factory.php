<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\Worker\Delegate;

use Neighborhoods\KojoExample\Worker\DelegateInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): DelegateInterface
    {
        $workerDelegate = $this->_getWorkerDelegateClone();

        return $workerDelegate;
    }
}