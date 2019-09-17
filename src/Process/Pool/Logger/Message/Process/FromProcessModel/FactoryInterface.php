<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessModel;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Process\FromProcessModelInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : FromProcessModelInterface;
}
