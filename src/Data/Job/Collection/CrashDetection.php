<?php

namespace NHDS\Jobs\Data\Job\Collection;

use NHDS\Jobs\Data\Job\AbstractCollection;
use NHDS\Jobs\Data\JobInterface;
use NHDS\Jobs\Data\Job\State;
use NHDS\Jobs\Db;

class CrashDetection extends AbstractCollection implements CrashDetectionInterface
{
    protected function _prepareCollection(): Db\Model\AbstractCollection
    {
        $select = $this->getSelect();
        $select->where(
            [
                JobInterface::FIELD_NAME_ASSIGNED_STATE => State\ServiceInterface::STATE_WORKING,
            ]
        );
        $select->columns(
            [
                JobInterface::FIELD_NAME_ID,
                JobInterface::FIELD_NAME_TYPE_CODE,
                JobInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL,
                JobInterface::FIELD_NAME_ASSIGNED_STATE,
                JobInterface::FIELD_NAME_NEXT_STATE_REQUEST,
                JobInterface::FIELD_NAME_PREVIOUS_STATE,
                JobInterface::FIELD_NAME_TIMES_CRASHED,
            ]
        );

        return $this;
    }
}