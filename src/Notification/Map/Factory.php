<?php

namespace Neighborhoods\Kojo\Notification\Map;

/**
 * @codeCoverageIgnore
 */
class Factory implements FactoryInterface
{

    use AwareTrait;

    public function create() : \Neighborhoods\Kojo\Notification\MapInterface
    {
        return clone $this->getRETS1NotificationMap();
    }


}

