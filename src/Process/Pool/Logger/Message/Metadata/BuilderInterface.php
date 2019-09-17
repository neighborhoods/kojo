<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\MetadataInterface;

interface BuilderInterface
{
    public function build() : MetadataInterface;

    public function setRecord(array $record) : BuilderInterface;
}
