<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Type\Collection;

use Neighborhoods\Kojo\Job\Type\CollectionAbstract;
use Neighborhoods\Kojo\Job\TypeInterface;
use Neighborhoods\Kojo\Db;

class Scheduler extends CollectionAbstract implements SchedulerInterface
{
    protected function _prepareCollection(): Db\Model\CollectionAbstract
    {
        $this->getQueryBuilder()->select('*')->where(TypeInterface::FIELD_NAME_CRON_EXPRESSION . ' IS NOT NULL');

        return $this;
    }
}