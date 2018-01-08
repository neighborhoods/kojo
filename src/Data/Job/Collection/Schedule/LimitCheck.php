<?php

namespace NHDS\Jobs\Data\Job\Collection\Schedule;

use NHDS\Jobs\Data\Job\AbstractCollection;
use NHDS\Jobs\Data\JobInterface;
use NHDS\Jobs\Data\Job\State;
use NHDS\Jobs\Db;

class LimitCheck extends AbstractCollection implements LimitCheckInterface
{
    protected function _prepareCollection(): Db\Model\AbstractCollection
    {
        $select = $this->getSelect();
        $select->where(
            [
                JobInterface::FIELD_NAME_ASSIGNED_STATE     => State\ServiceInterface::STATE_WAITING,
                JobInterface::FIELD_NAME_NEXT_STATE_REQUEST => State\ServiceInterface::STATE_SCHEDULE_LIMIT_CHECK,
            ]
        );
        $select->columns(
            [
                JobInterface::FIELD_NAME_ID,
                JobInterface::FIELD_NAME_TYPE_CODE,
                JobInterface::FIELD_NAME_PRIORITY,
                JobInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL,
                JobInterface::FIELD_NAME_ASSIGNED_STATE,
                JobInterface::FIELD_NAME_NEXT_STATE_REQUEST,
                JobInterface::FIELD_NAME_PREVIOUS_STATE,
            ]
        );

        return $this;
    }
}