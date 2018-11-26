<?php

namespace Neighborhoods\Kojo\Notification\Builder;

/**
 * @codeCoverageIgnore
 */
class Factory implements FactoryInterface
{

    use AwareTrait;

    public function create() : \Neighborhoods\Kojo\Notification\BuilderInterface
    {
        return clone $this->getRETS1NotificationBuilder();
    }


}

