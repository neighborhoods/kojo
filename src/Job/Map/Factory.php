<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Map;

use Neighborhoods\Kojo\Job\MapInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getJobMap()->getArrayCopy();
    }
}
