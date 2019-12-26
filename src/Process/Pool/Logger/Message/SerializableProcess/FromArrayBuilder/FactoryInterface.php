<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromArrayBuilder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess\FromArrayBuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : FromArrayBuilderInterface;
}
