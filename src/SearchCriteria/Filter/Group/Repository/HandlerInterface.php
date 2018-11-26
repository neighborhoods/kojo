<?php

namespace Neighborhoods\Kojo\SearchCriteria\Filter\Group\Repository;

interface HandlerInterface extends \Psr\Http\Server\RequestHandlerInterface
{

    const ROUTE_PATH_FILTERS = '//search-criteria-filter-group/{searchCriteria:}';

    const ROUTE_NAME_FILTERS = 'Filters';


}

