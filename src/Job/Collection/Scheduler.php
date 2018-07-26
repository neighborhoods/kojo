<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Collection;

use Neighborhoods\Kojo\Job\CollectionAbstract;
use Neighborhoods\Kojo\JobInterface;
use Neighborhoods\Kojo\Db;
use Neighborhoods\Kojo\Scheduler\CacheInterface;

class Scheduler extends CollectionAbstract implements SchedulerInterface
{
    const PROP_DATE_TIME = 'date_time';

    public function setReferenceDateTime(\DateTime $dateTime): Scheduler
    {
        $this->_create(self::PROP_DATE_TIME, $dateTime);

        return $this;
    }

    protected function _getReferenceDateTime(): \DateTime
    {
        return $this->_read(self::PROP_DATE_TIME);
    }

    protected function &_getRecords(): array
    {
        if (!$this->_exists(self::PROP_RECORDS)) {
            $this->_prepareCollection();
            $records = [];
            $results = $this->getQueryBuilder()->execute()->fetchAll();
            foreach ($results as $result) {
                $typeCode = JobInterface::FIELD_NAME_TYPE_CODE;
                $records[$result[$typeCode]][$result[JobInterface::FIELD_NAME_WORK_AT_DATE_TIME]] = 1;
            }
            if ($records === false) {
                $this->_create(self::PROP_RECORDS, []);
            } else {
                $this->_create(self::PROP_RECORDS, $records);
            }
        }

        return $this->_read(self::PROP_RECORDS);
    }

    protected function _prepareCollection(): Db\Model\CollectionAbstract
    {
        $this->getQueryBuilder()->select([
            JobInterface::FIELD_NAME_TYPE_CODE,
            JobInterface::FIELD_NAME_WORK_AT_DATE_TIME
        ]);
        $workAtDateTime = $this->_getReferenceDateTime()->format(CacheInterface::DATE_TIME_FORMAT_MYSQL_MINUTE);
        $this->getQueryBuilder()->where(
            $this->getQueryBuilder()->expr()->gte(
                JobInterface::FIELD_NAME_WORK_AT_DATE_TIME,
                $this->getQueryBuilder()->createNamedParameter($workAtDateTime)
            )
        );

        return $this;
    }
}