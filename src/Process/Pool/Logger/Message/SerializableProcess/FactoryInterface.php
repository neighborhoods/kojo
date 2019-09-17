<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcessInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : SerializableProcessInterface;
}
