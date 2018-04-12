<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\Collection;

use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\State;
use Neighborhoods\Kojo\Data\Job\CollectionAbstract;
use Neighborhoods\Kojo\Data\Job\Type;
use Neighborhoods\Kojo\Db\Connection\ContainerInterface;
use Neighborhoods\Kojo\Db;
use Zend\Db\Sql\Expression;

class ScheduleLimit extends CollectionAbstract implements ScheduleLimitInterface
{
    use Type\AwareTrait;
    const ALIAS_NUMBER_OF_SCHEDULED_JOBS = 'number_of_scheduled_jobs';

    public function getNumberOfCurrentlyScheduledJobs(): int
    {
        return (int)$this->_getRecords()[self::ALIAS_NUMBER_OF_SCHEDULED_JOBS];
    }

    protected function &_getRecords(): array
    {
        if (!$this->_exists(self::PROP_RECORDS)) {
            $this->_prepareCollection();
            $select = $this->getSelect();
            $dbConnectionContainer = $this->_getDbConnectionContainerRepository()->get(ContainerInterface::ID_JOB);
            $statement = $dbConnectionContainer->getStatement($select);
            /** @var \PDOStatement $pdoStatement */
            $pdoStatement = $statement->execute()->getResource();
            $pdoStatement->setFetchMode($this->_getFetchMode());
            $records = $pdoStatement->fetchAll()[0];
            $this->_logSelect();
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
        $this->getSelect()->columns(
            [
                self::ALIAS_NUMBER_OF_SCHEDULED_JOBS => new Expression('COUNT(' . JobInterface::FIELD_NAME_ID . ')'),
            ]
        );
        $this->getSelect()->where->equalTo(JobInterface::FIELD_NAME_TYPE_CODE, $this->_getJobType()->getCode());
        $this->getSelect()
            ->where
            ->nest()
            ->equalTo(JobInterface::FIELD_NAME_ASSIGNED_STATE, State\Service::STATE_WORKING)
            ->or
            ->equalTo(JobInterface::FIELD_NAME_NEXT_STATE_REQUEST, State\Service::STATE_WORKING);

        return $this;
    }
}