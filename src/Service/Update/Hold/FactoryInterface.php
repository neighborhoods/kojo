<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Update\Hold;

use Neighborhoods\Kojo\Service\Update\HoldInterface;

interface FactoryInterface
{
    public function create(): HoldInterface;
}