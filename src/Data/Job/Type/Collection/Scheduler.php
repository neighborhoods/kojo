<?php

namespace NHDS\Jobs\Data\Job\Type\Collection;

use NHDS\Jobs\Data\Job\Type\CollectionAbstract;
use NHDS\Jobs\Data\Job\TypeInterface;
use NHDS\Jobs\Db;

class Scheduler extends CollectionAbstract implements SchedulerInterface
{
    protected function _prepareCollection(): Db\Model\CollectionAbstract
    {
        $this->getSelect()->where(TypeInterface::FIELD_NAME_CRON_EXPRESSION . ' IS NOT NULL');

        return $this;
    }
}