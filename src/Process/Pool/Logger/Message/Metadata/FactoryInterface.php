<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Logger\Message\Metadata;

use Neighborhoods\Kojo\Process\Pool\Logger\Message\MetadataInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : MetadataInterface;
}
