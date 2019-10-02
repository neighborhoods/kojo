<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Data;

use Neighborhoods\Kojo\JobStateChange\DataInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : DataInterface
    {
        return clone $this->getJobStateChangeData();
    }
}
