<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where;

use Neighborhoods\Kojo\WhereInterface;

interface FactoryInterface
{
    public function create(): WhereInterface;
}
