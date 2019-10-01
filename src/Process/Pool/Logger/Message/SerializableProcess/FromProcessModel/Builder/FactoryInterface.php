<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModel\Builder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModel\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : BuilderInterface;
}
