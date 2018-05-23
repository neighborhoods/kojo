<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Model;

use Doctrine\DBAL\Query\QueryBuilder;
use Neighborhoods\Kojo\Db\Model;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Neighborhoods\Kojo\Doctrine;
use Neighborhoods\Kojo\Process;

abstract class CollectionAbstract implements CollectionInterface
{
    use Defensive\AwareTrait;
    use Model\AwareTrait;
    use Process\Pool\Logger\AwareTrait;
    use Doctrine\Connection\Decorator\Repository\AwareTrait;
    const PROP_QUERY_BUILDER = 'query_builder';
    const PROP_MODELS = 'models';
    const PROP_RECORDS = 'records';
    const PROP_FETCH_MODE = 'fetch_mode';

    public function getQueryBuilder(): QueryBuilder
    {
        if (!$this->_exists(self::PROP_QUERY_BUILDER)) {
            $connectionDecoratorRepository = $this->_getDoctrineConnectionDecoratorRepository();
            $queryBuilder = $connectionDecoratorRepository->createQueryBuilder(DecoratorInterface::ID_JOB);
            $queryBuilder = $queryBuilder->select()->from($this->_getModel()->getTableName());
            $this->_create(self::PROP_QUERY_BUILDER, $queryBuilder);
        }

        return $this->_read(self::PROP_QUERY_BUILDER);
    }

    protected function _setFetchMode(int $fetchMode): CollectionAbstract
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
                $model->createPersistentProperties($record);
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
            $records = $this->getQueryBuilder()->execute()->fetchAll();
            if ($records === false) {
                $this->_create(self::PROP_RECORDS, []);
            }else {
                $this->_create(self::PROP_RECORDS, $records);
            }
        }

        return $this->_read(self::PROP_RECORDS);
    }

    abstract protected function _prepareCollection(): CollectionAbstract;
}