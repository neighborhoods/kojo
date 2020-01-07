<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Map\Builder;

use Neighborhoods\Kojo\JobStateChange\Map\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : BuilderInterface
    {
        return clone $this->getJobStateChangeMapBuilder();
    }
}
