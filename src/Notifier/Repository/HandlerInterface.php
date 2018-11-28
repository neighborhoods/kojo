<?php

namespace Neighborhoods\Kojo\Notifier\Repository;

interface HandlerInterface extends \Psr\Http\Server\RequestHandlerInterface
{

    const ROUTE_PATH_AskS = '/Ask/notifier/{where:}';

    const ROUTE_NAME_AskS = 'Asks';


}

