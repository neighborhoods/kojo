<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

class Notifier implements NotifierInterface
{
    public function notify(Notification $notify): NotifierInterface
    {
        return $this;
    }
}
