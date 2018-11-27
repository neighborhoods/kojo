<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where;

use Neighborhoods\Kojo\WhereInterface;

interface BuilderInterface
{
    public function build(): WhereInterface;
}
