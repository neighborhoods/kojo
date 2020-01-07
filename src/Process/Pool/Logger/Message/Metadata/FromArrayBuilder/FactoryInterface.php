<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\FromArrayBuilder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\FromArrayBuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : FromArrayBuilderInterface;
}
