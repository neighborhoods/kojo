<?php
declare(strict_types=1);

namespace NHDS\Jobs\Db\Schema;

use NHDS\Jobs\Db;
use NHDS\Jobs\Db\Connection\ContainerInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\SqlInterface;

abstract class VersionAbstract implements VersionInterface
{
    use Db\Connection\Container\AwareTrait;
    protected $_schemaChanges;

    public function applySchemaChanges(): VersionInterface
    {
        $this->_getDbConnectionContainer(ContainerInterface::NAME_SCHEMA)->getAdapter()->query(
            $this->_getDbConnectionContainer(ContainerInterface::NAME_SCHEMA)->getSql()->buildSqlString(
                $this->_getSchemaChanges()
            ),
            Adapter::QUERY_MODE_EXECUTE
        );

        return $this;
    }

    protected function _setSchemaChanges(SqlInterface $schemaChanges): VersionAbstract
    {
        if (!$this->_hasSchemaChanges()) {
            $this->_schemaChanges = $schemaChanges;
        }else {
            throw new \LogicException('Schema changes is already set.');
        }

        return $this;
    }

    protected function _getSchemaChanges(): SqlInterface
    {
        if (!$this->_hasSchemaChanges()) {
            throw new \LogicException('Schema changes is not set');
        }

        return $this->_schemaChanges;
    }

    protected function _hasSchemaChanges(): bool
    {
        return $this->_schemaChanges === null ? false : true;
    }
}