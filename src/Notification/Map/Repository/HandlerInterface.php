<?php

namespace Neighborhoods\Kojo\Notification\Map\Repository;

interface HandlerInterface extends \Psr\Http\Server\RequestHandlerInterface
{

    const ROUTE_PATH_NOTIFICATIONS = '/rets1/notification/{searchCriteria:}';

    const ROUTE_NAME_NOTIFICATIONS = 'Notifications';


}

