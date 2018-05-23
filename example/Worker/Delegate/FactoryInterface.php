<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Example\Worker\Delegate;

use Neighborhoods\Kojo\Example\Worker\DelegateInterface;

interface FactoryInterface
{
    public function create(): DelegateInterface;
}