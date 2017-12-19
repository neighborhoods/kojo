<?php

namespace NHDS\Jobs\Db\Model;

use NHDS\Jobs\Db\Connection\ContainerInterface;
use NHDS\Jobs\Db\Model;
use NHDS\Toolkit\Data\Property\Crud;
use NHDS\Jobs\Db;
use Zend\Db\Sql\Select;

abstract class AbstractCollection implements CollectionInterface
{
    use Crud\AwareTrait;
    use Model\AwareTrait;
    use Db\Connection\Container\AwareTrait;
    const PROP_SELECT     = 'select';
    const PROP_MODELS     = 'models';
    const PROP_RECORDS    = 'records';
    const PROP_FETCH_MODE = 'fetch_mode';

    public function getSelect(): Select
    {
        if (!$this->_exists(self::PROP_SELECT)) {
            $dbConnectionContainer = $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB);
            $select = $dbConnectionContainer->select($this->_getModel()->getTableName());
            $this->_create(self::PROP_SELECT, $select);
        }

        return $this->_read(self::PROP_SELECT);
    }

    protected function _setFetchMode(int $fetchMode): AbstractCollection
    {
        $this->_create(self::PROP_FETCH_MODE, $fetchMode);

        return $this;
    }

    protected function _getFetchMode(): int
    {
        if (!$this->_exists(self::PROP_FETCH_MODE)) {
            $this->_create(self::PROP_FETCH_MODE, \PDO::FETCH_ASSOC);
        }

        return $this->_read(self::PROP_FETCH_MODE);
    }

    public function &getModelsArray(): array
    {
        return $this->_getModelsArray();
    }

    protected function &_getModelsArray(): array
    {
        if (!$this->_exists(self::PROP_MODELS)) {
            $models = [];
            $records = &$this->getRecords();
            foreach ($records as $record) {
                $model = $this->_getModelClone();
                $model->setPersistentProperties($record);
                $models[] = $model;
            }
            $this->_create(self::PROP_MODELS, $models);
        }

        return $this->_read(self::PROP_MODELS);
    }

    public function &getRecords(): array
    {
        return $this->_getRecords();
    }

    protected function &_getRecords(): array
    {
        if (!$this->_exists(self::PROP_RECORDS)) {
            $this->_prepareCollection();
            $select = $this->getSelect();
            $statement = $this->_getDbConnectionContainer(ContainerInterface::NAME_JOB)->getStatement($select);
            /** @var \PDOStatement $pdoStatement */
            $pdoStatement = $statement->execute()->getResource();
            $pdoStatement->setFetchMode($this->_getFetchMode());
            $records = $pdoStatement->fetchAll();
            if ($records === false) {
                $this->_create(self::PROP_RECORDS, []);
            }else {
                $this->_create(self::PROP_RECORDS, $records);
            }
        }

        return $this->_read(self::PROP_RECORDS);
    }

    abstract protected function _prepareCollection(): AbstractCollection;
}