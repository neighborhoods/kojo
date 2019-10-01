<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Builder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : BuilderInterface;
}
