<?php

namespace Neighborhoods\Kojo\Notifier\Builder;

/**
 * @codeCoverageIgnore
 */
class Factory implements FactoryInterface
{

    use AwareTrait;

    public function create() : \Neighborhoods\Kojo\Notifier\BuilderInterface
    {
        return clone $this->getRETS1NotifierBuilder();
    }


}

