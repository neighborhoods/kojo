<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\Worker\Delegate;

use Neighborhoods\KojoExample\Worker\DelegateInterface;

interface RepositoryInterface
{
    public function getNewWorkerDelegate(): DelegateInterface;
}