<?php
declare(strict_types=1);

namespace NHDS\Jobs\Type\Perpetual;

use NHDS\Jobs\Data\Job\Type\PerpetualInterface;

interface SelectorInterface
{
    public function hasWorkablePerpetualJobType(): bool;

    public function getWorkablePerpetualJobType(): PerpetualInterface;
}