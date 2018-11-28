<?php

namespace Neighborhoods\Kojo\Notifier\Map;

/**
 * @codeCoverageIgnore
 */
class Factory implements FactoryInterface
{

    use AwareTrait;

    public function create() : \Neighborhoods\Kojo\Notifier\MapInterface
    {
        return clone $this->getAskNotifierMap();
    }


}

