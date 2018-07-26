<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\Failed;

use Neighborhoods\Kojo\Service\Update\Complete\FailedInterface;

interface FactoryInterface
{
    public function create(): FailedInterface;
}