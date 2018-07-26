<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Builder;

use Neighborhoods\Kojo\Job\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getJobBuilder();
    }
}
