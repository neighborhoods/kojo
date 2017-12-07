<?php

namespace NHDS\Jobs\Data\Job\Type\Collection;

use NHDS\Jobs\Data\Job\Type\Collection;

interface ServiceInterface
{
    public function getAllJobTypes(): Collection;
}