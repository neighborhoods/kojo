<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\V1\Worker\Delegate;

use Neighborhoods\KojoExample\V1\Worker\DelegateInterface;

interface RepositoryInterface
{
    public function getV1NewWorkerDelegate(): DelegateInterface;
}