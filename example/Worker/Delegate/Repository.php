<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Example\Worker\Delegate;

use Neighborhoods\Kojo\Example\Worker\DelegateInterface;
use Neighborhoods\Kojo\Example\Worker;

class Repository implements RepositoryInterface
{
    use Worker\Delegate\Factory\AwareTrait;

    public function getNewWorkerDelegate(): DelegateInterface
    {
        return $this->_getWorkerDelegateFactory()->create();
    }
}