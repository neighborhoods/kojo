<?php

namespace Neighborhoods\Kojo\Notification;

/**
 * @codeCoverageIgnore
 */
interface FactoryInterface
{

    public function create() : \Neighborhoods\Kojo\NotificationInterface;

}

