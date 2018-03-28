<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\Collection;

use Neighborhoods\Kojo\Data\Job\CollectionAbstract;
use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\Db\Connection\ContainerInterface;
use Neighborhoods\Kojo\Db;

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
            $select = $this->getSelect();
            $statement = $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->getStatement($select);
            /** @var \PDOStatement $pdoStatement */
            $pdoStatement = $statement->execute()->getResource();
            $pdoStatement->setFetchMode(\PDO::FETCH_NUM);
            $records = [];
            while ($record = $pdoStatement->fetch()) {
                $records[$record[0]][$record[1]] = 1;
            }
            if ($records === false) {
                $this->_create(self::PROP_RECORDS, []);
            }else {
                $this->_create(self::PROP_RECORDS, $records);
            }
        }

        return $this->_read(self::PROP_RECORDS);
    }

    protected function _prepareCollection(): Db\Model\CollectionAbstract
    {
        $this->getSelect()->columns([JobInterface::FIELD_NAME_TYPE_CODE, JobInterface::FIELD_NAME_WORK_AT_DATE_TIME]);
        $workAtDateTime = $this->_getReferenceDateTime()->format('Y-m-d H:i:0');
        $this->getSelect()->where(JobInterface::FIELD_NAME_WORK_AT_DATE_TIME . ' >= "' . $workAtDateTime . '"');
        $this->_logSelect();

        return $this;
    }
}