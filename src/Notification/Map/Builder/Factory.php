<?php

namespace Neighborhoods\Kojo\Notification\Map\Builder;

/**
 * @codeCoverageIgnore
 */
class Factory implements FactoryInterface
{

    use AwareTrait;

    public function create() : \Neighborhoods\Kojo\Notification\Map\BuilderInterface
    {
        return clone $this->getAskNotificationMapBuilder();
    }


}

