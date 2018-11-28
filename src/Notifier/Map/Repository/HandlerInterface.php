<?php

namespace Neighborhoods\Kojo\Notifier\Map\Repository;

interface HandlerInterface extends \Psr\Http\Server\RequestHandlerInterface
{

    const ROUTE_PATH_NOTIFIERS = '/Ask/notifier/{where:}';

    const ROUTE_NAME_NOTIFIERS = 'Notifiers';


}

