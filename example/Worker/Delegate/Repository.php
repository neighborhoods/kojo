<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\Worker\Delegate;

use Neighborhoods\KojoExample\Worker\DelegateInterface;
use Neighborhoods\KojoExample\Worker;

class Repository implements RepositoryInterface
{
    use Worker\Delegate\Factory\AwareTrait;

    public function getNewWorkerDelegate(): DelegateInterface
    {
        return $this->_getWorkerDelegateFactory()->create();
    }
}