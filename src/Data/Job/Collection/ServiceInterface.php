<?php

namespace NHDS\Jobs\Data\Job\Collection;

use NHDS\Jobs\Data\Job\Collection;

interface ServiceInterface
{
    public function getNamedCollection(string $collectionName): Collection;
}