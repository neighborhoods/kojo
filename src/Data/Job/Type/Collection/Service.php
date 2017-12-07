<?php

namespace NHDS\Jobs\Data\Job\Type\Collection;

use NHDS\Jobs\Data\Job\Type\Collection;
use NHDS\Toolkit\Data\Property\Crud;

class Service implements ServiceInterface
{
    use Collection\AwareTrait;
    use Crud\AwareTrait;

    public function getAllJobTypes(): Collection
    {
        return $this->_getCollection();
    }
}