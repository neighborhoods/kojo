<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Notification;

use Neighborhoods\Kojo\NotificationInterface;
use Neighborhoods\Kojo\Notification;

class Service implements ServiceInterface
{
    use Notification\Builder\AwareTrait;

    public function createNotification(): NotificationInterface
    {

    }

    public function notify(NotificationInterface $notification): ServiceInterface
    {
        return $this;
    }
}
