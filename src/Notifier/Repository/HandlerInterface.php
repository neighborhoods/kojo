<?php

namespace Neighborhoods\Kojo\Notifier\Repository;

interface HandlerInterface extends \Psr\Http\Server\RequestHandlerInterface
{

    const ROUTE_PATH_RETS1S = '/rets1/notifier/{where:}';

    const ROUTE_NAME_RETS1S = 'RETS1s';


}

