<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Collection;

use Neighborhoods\Kojo\Job\CollectionAbstract;
use Neighborhoods\Kojo\JobInterface;
use Neighborhoods\Kojo\Db;

class Delete extends CollectionAbstract implements DeleteInterface
{
    protected function &_getModelsArray(): array
    {
        $models = [];
        $records = &$this->getRecords();
        foreach ($records as $record) {
            $model = $this->_getModelClone();
            $model->createPersistentProperties($record);
            $models[] = $model;
        }

        return $models;
    }

    protected function &_getRecords(): array
    {
        if (!$this->_exists(self::PROP_RECORDS)) {
            $this->_prepareCollection();
            $this->_create(self::PROP_RECORDS, []);
        }
        $records = $this->getQueryBuilder()->execute()->fetchAll();
        if ($records === false) {
            $this->_update(self::PROP_RECORDS, []);
        } else {
            $this->_update(self::PROP_RECORDS, $records);
        }

        return $this->_read(self::PROP_RECORDS);
    }

    protected function _prepareCollection(): Db\Model\CollectionAbstract
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->select(
            [
                JobInterface::FIELD_NAME_ID,
            ]
        );
        $queryBuilder->where(
            $this->getQueryBuilder()->expr()->lte(
                JobInterface::FIELD_NAME_DELETE_AFTER_DATE_TIME,
                $this->getQueryBuilder()->createNamedParameter(gmdate("Y-m-d H:i:s"))
            )
        );

        return $this;
    }
}