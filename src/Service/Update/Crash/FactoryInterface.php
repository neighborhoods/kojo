<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Crash;

use Neighborhoods\Kojo\Service\Update\CrashInterface;

interface FactoryInterface
{
    public function create(): CrashInterface;
}