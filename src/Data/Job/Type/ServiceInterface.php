<?php

namespace NHDS\Jobs\Data\Job\Type;

use NHDS\Jobs\Data\Job\TypeInterface;

interface ServiceInterface
{
    public function setJobType(TypeInterface $jobType);

    public function save();
}