<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Map\Repository;

interface HandlerInterface extends \Psr\Http\Server\RequestHandlerInterface
{

    const ROUTE_PATH_GROUPS = '//search-criteria-filter-group/{searchCriteria:}';

    const ROUTE_NAME_GROUPS = 'Groups';


}

