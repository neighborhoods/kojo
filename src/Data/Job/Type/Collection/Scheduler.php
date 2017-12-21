<?php

namespace NHDS\Jobs\Data\Job\Type\Collection;

use NHDS\Jobs\Data\Job\Type\AbstractCollection;
use NHDS\Jobs\Data\Job\TypeInterface;
use NHDS\Jobs\Db\Connection\ContainerInterface;
use NHDS\Jobs\Db;

class Scheduler extends AbstractCollection implements SchedulerInterface
{
    protected function _prepareCollection(): Db\Model\AbstractCollection
    {
        $this->getSelect()->where(TypeInterface::FIELD_NAME_CRON_EXPRESSION . ' IS NOT NULL');

        return $this;
    }
}