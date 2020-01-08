<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\Host;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata\HostInterface;

interface FromArrayBuilderInterface
{
    public function build() : HostInterface;

    public function setRecord(array $record) : FromArrayBuilderInterface;
}
