<?php

namespace NHDS\Jobs\Data\Job\Collection\Pending;

use NHDS\Jobs\Data\Job\Collection;
use NHDS\Jobs\Data\JobInterface;
use NHDS\Jobs\Data\Job\State;
use NHDS\Jobs\Db\Model\AbstractCollection;

class LimitCheck extends Collection implements LimitCheckInterface
{
    protected function _prepareCollection(): AbstractCollection
    {
        $select = $this->getSelect();
        $select->where(
            [
                JobInterface::FIELD_NAME_ASSIGNED_STATE => State\ServiceInterface::STATE_PENDING_LIMIT_CHECK,
            ]
        );
        $select->columns(
            [
                JobInterface::FIELD_NAME_ID,
                JobInterface::FIELD_NAME_TYPE_CODE,
                JobInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL,
            ]
        );

        return $this;
    }
}