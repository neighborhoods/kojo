<?php

namespace NHDS\Jobs\Data\Job\Service\Update;

use NHDS\Jobs\Data\Job\ServiceInterface;

interface WorkInterface extends ServiceInterface
{
    public function save(): WorkInterface;
}