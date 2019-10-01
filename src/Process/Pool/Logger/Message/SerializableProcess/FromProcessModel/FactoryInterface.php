<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModel;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromProcessModelInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : FromProcessModelInterface;
}
