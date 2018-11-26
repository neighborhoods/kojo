<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Notification;

interface NotifierInterface
{
    public function notify(Notification $notify): NotifierInterface;
}
