<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Type;

use Neighborhoods\Kojo\Job\TypeInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): TypeInterface;
}
