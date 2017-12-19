<?php

namespace NHDS\Jobs\Data\Job\Service\Update;

use NHDS\Jobs\Data\Job\ServiceInterface;

interface PanicInterface extends ServiceInterface
{
    public function save(): PanicInterface;
}