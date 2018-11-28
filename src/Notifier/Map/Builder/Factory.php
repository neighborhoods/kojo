<?php

namespace Neighborhoods\Kojo\Notifier\Map\Builder;

/**
 * @codeCoverageIgnore
 */
class Factory implements FactoryInterface
{

    use AwareTrait;

    public function create() : \Neighborhoods\Kojo\Notifier\Map\BuilderInterface
    {
        return clone $this->getAskNotifierMapBuilder();
    }


}

