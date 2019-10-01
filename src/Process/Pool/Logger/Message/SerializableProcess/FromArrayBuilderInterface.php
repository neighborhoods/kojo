<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcess;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\SerializableProcessInterface;

interface FromArrayBuilderInterface
{
    public function setRecord(array $record) : FromArrayBuilderInterface;

    public function build() : SerializableProcessInterface;
}
