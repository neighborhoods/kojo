<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Complete\FailedScheduleLimitCheck;

use Neighborhoods\Kojo\Service\Update\Complete\FailedScheduleLimitCheckInterface;

interface FactoryInterface
{
    public function create(): FailedScheduleLimitCheckInterface;
}