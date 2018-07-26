<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Map;

use Neighborhoods\Kojo\Process\MapInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): MapInterface
    {
        return $this->getProcessMap()->getArrayCopy();
    }
}
