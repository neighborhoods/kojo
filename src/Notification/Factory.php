<?php

namespace Neighborhoods\Kojo\Notification;

/**
 * @codeCoverageIgnore
 */
class Factory implements FactoryInterface
{

    use AwareTrait;

    public function create() : \Neighborhoods\Kojo\NotificationInterface
    {
        return clone $this->getRETS1Notification();
    }


}

