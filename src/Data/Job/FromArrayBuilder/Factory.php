<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\FromArrayBuilder;

use Neighborhoods\Kojo\Data\Job\FromArrayBuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create() : FromArrayBuilderInterface
    {
        return clone $this->getDataJobFromArrayBuilder();
    }
}
