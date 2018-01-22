<?php
declare(strict_types=1);

namespace NHDS\Jobs\Perpetual;

use NHDS\Jobs\Data\Job\Type\PerpetualInterface;

interface SelectorInterface
{
    public function hasPerpetualJobType(): bool;

    public function getPerpetualJobType(): PerpetualInterface;
}