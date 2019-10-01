<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Host\FromArrayBuilder;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Host\FromArrayBuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : FromArrayBuilderInterface;
}
