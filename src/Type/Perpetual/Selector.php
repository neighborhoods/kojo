<?php
declare(strict_types=1);

namespace NHDS\Jobs\Type\Perpetual;

use NHDS\Jobs\Data\Job\Type\PerpetualInterface;

class Selector implements SelectorInterface
{
    public function hasWorkablePerpetualJobType(): bool
    {
        // TODO: Implement hasPerpetualJobType() method.
    }

    public function getWorkablePerpetualJobType(): PerpetualInterface
    {
        // TODO: Implement getPerpetualJobType() method.
    }
}