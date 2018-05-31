<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\Collection\Schedule;

use Neighborhoods\Kojo\Data\Job\CollectionAbstract;
use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\State;
use Neighborhoods\Kojo\Db;

class LimitCheck extends CollectionAbstract implements LimitCheckInterface
{
    protected function _prepareCollection(): Db\Model\CollectionAbstract
    {
        $select = $this->getQueryBuilder();
        $select->select(
            [
                JobInterface::FIELD_NAME_ID,
                JobInterface::FIELD_NAME_TYPE_CODE,
                JobInterface::FIELD_NAME_PRIORITY,
                JobInterface::FIELD_NAME_WORK_AT_DATE_TIME,
                JobInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL,
                JobInterface::FIELD_NAME_ASSIGNED_STATE,
                JobInterface::FIELD_NAME_NEXT_STATE_REQUEST,
                JobInterface::FIELD_NAME_PREVIOUS_STATE,
            ]
        );
        $this->getQueryBuilder()->where(
            $this->getQueryBuilder()->expr()->andX(
                $this->getQueryBuilder()->expr()->eq(
                    JobInterface::FIELD_NAME_NEXT_STATE_REQUEST,
                    $this->getQueryBuilder()->createNamedParameter(State\ServiceInterface::STATE_SCHEDULE_LIMIT_CHECK)
                ),
                $this->getQueryBuilder()->expr()->eq(
                    JobInterface::FIELD_NAME_ASSIGNED_STATE,
                    $this->getQueryBuilder()->createNamedParameter(State\ServiceInterface::STATE_WAITING)
                ),
                $this->getQueryBuilder()->expr()->lte(
                    JobInterface::FIELD_NAME_WORK_AT_DATE_TIME,
                    $this->getQueryBuilder()->createNamedParameter(gmdate("Y-m-d H:i:s"))
                )
            )
        );
        $select->addOrderBy(JobInterface::FIELD_NAME_WORK_AT_DATE_TIME);

        return $this;
    }
}