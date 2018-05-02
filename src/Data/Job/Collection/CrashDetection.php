<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\Collection;

use Neighborhoods\Kojo\Data\Job\CollectionAbstract;
use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\State;
use Neighborhoods\Kojo\Db;

class CrashDetection extends CollectionAbstract implements CrashDetectionInterface
{
    protected function _prepareCollection(): Db\Model\CollectionAbstract
    {
        $select = $this->getSelect();
        $select->where(
            [
                JobInterface::FIELD_NAME_ASSIGNED_STATE => State\ServiceInterface::STATE_WORKING,
            ]
        );
        $select->columns(
            [
                JobInterface::FIELD_NAME_ASSIGNED_STATE,
                JobInterface::FIELD_NAME_ID,
                JobInterface::FIELD_NAME_TYPE_CODE,
                JobInterface::FIELD_NAME_PRIORITY,
                JobInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL,
                JobInterface::FIELD_NAME_NEXT_STATE_REQUEST,
                JobInterface::FIELD_NAME_PREVIOUS_STATE,
                JobInterface::FIELD_NAME_TIMES_CRASHED,
            ]
        );
        $select->order(JobInterface::FIELD_NAME_PRIORITY . ' DESC');
        $this->_logSelect();

        return $this;
    }
}