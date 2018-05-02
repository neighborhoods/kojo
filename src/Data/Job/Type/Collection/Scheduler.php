<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\Type\Collection;

use Neighborhoods\Kojo\Data\Job\Type\CollectionAbstract;
use Neighborhoods\Kojo\Data\Job\TypeInterface;
use Neighborhoods\Kojo\Db;

class Scheduler extends CollectionAbstract implements SchedulerInterface
{
    protected function _prepareCollection(): Db\Model\CollectionAbstract
    {
        $this->getSelect()->where(TypeInterface::FIELD_NAME_CRON_EXPRESSION . ' IS NOT NULL');

        return $this;
    }
}