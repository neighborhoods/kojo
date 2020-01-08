<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\MetadataInterface;

interface FromArrayBuilderInterface
{
    public function setRecord(array $record) : FromArrayBuilderInterface;

    public function build() : MetadataInterface;
}
