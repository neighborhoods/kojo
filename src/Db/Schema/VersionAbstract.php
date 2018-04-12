<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Schema;

use Neighborhoods\Kojo\Db;
use Neighborhoods\Kojo\Db\Connection\ContainerInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\SqlInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;

abstract class VersionAbstract implements VersionInterface
{
    use Defensive\AwareTrait;
    use Db\Connection\Container\Repository\AwareTrait;
    protected $_schemaChanges;

    public function applySchemaChanges(): VersionInterface
    {
        $dbConnectionContainer = $this->_getDbConnectionContainerRepository()->get(ContainerInterface::ID_SCHEMA);
        $dbConnectionContainer->getAdapter()->query(
            $dbConnectionContainer->getSql()->buildSqlString($this->_getSchemaChanges()),
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