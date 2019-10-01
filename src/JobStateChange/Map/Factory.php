<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Map;

use Neighborhoods\Kojo\JobStateChange\MapInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : MapInterface
    {
        return $this->getJobStateChangeMap()->getArrayCopy();
    }
}
