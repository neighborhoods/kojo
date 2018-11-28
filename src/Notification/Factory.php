<?php

namespace Neighborhoods\Kojo\Notification;

use Neighborhoods\Kojo\NotificationInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): NotificationInterface
    {
        return clone $this->getAskNotification();
    }
}
