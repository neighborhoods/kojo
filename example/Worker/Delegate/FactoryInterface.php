<?php
declare(strict_types=1);

namespace Neighborhoods\KojoExample\Worker\Delegate;

use Neighborhoods\KojoExample\Worker\DelegateInterface;

interface FactoryInterface
{
    public function create(): DelegateInterface;
}