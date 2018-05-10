<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Example\Worker\Delegate;

use Neighborhoods\Kojo\Example\Worker\DelegateInterface;

interface RepositoryInterface
{
    public function getNewWorkerDelegate(): DelegateInterface;
}