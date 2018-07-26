<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Create\Builder;

use Neighborhoods\Kojo\Service\Create\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getServiceCreateBuilder();
    }
}
