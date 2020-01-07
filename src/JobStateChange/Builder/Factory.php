<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Builder;

use Neighborhoods\Kojo\JobStateChange\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : BuilderInterface
    {
        return clone $this->getJobStateChangeBuilder();
    }
}
