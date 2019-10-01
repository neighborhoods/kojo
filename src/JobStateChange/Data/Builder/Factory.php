<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Data\Builder;

use Neighborhoods\Kojo\JobStateChange\Data\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : BuilderInterface
    {
        return clone $this->getJobStateChangeDataBuilder();
    }
}
