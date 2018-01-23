<?php
declare(strict_types=1);

namespace NHDS\Jobs\Db\Setup\Schema;

use NHDS\Jobs\Db\Schema\VersionAbstract;
use NHDS\Jobs\Db\Schema\VersionInterface;
use NHDS\Jobs\Data\Job\Type;
use Zend\Db\Sql\Ddl\Column\BigInteger;
use Zend\Db\Sql\Ddl\Column\Boolean;
use Zend\Db\Sql\Ddl\Column\Varchar;
use Zend\Db\Sql\Ddl\Constraint\PrimaryKey;
use Zend\Db\Sql\Ddl\Constraint\UniqueKey;
use Zend\Db\Sql\Ddl\CreateTable;
use Zend\Db\Sql\Ddl\Index\Index;

class Version_6_0_0 extends VersionAbstract
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $createTable = new CreateTable(Type\PerpetualInterface::TABLE_NAME);
        $createTable->addColumn(
            new BigInteger(
                Type\PerpetualInterface::FIELD_NAME_ID, false, null,
                [
                    'comment'  => 'The unique ID of this Job type.',
                    'identity' => true,
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Varchar(
                Type\PerpetualInterface::FIELD_NAME_TYPE_CODE, 255, false, null,
                [
                    'comment' => 'The unique code of this perpetual job type.',
                ]));
        $createTable->addColumn(
            new Varchar(
                Type\PerpetualInterface::FIELD_NAME_NAME, 255, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Varchar(
                Type\PerpetualInterface::FIELD_NAME_WORKER_URI, 255, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Varchar(
                Type\PerpetualInterface::FIELD_NAME_WORKER_METHOD, 255, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Boolean(
                Type\PerpetualInterface::FIELD_NAME_IS_ENABLED, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addConstraint(
            new PrimaryKey(
                Type\PerpetualInterface::FIELD_NAME_ID,
                Type\PerpetualInterface::FIELD_NAME_ID
            )
        );
        $createTable->addConstraint(
            new UniqueKey(
                Type\PerpetualInterface::FIELD_NAME_TYPE_CODE,
                Type\PerpetualInterface::FIELD_NAME_TYPE_CODE
            )
        );
        $createTable->addConstraint(
            new Index(
                [
                    Type\PerpetualInterface::FIELD_NAME_IS_ENABLED,
                    Type\PerpetualInterface::FIELD_NAME_TYPE_CODE,
                    Type\PerpetualInterface::FIELD_NAME_WORKER_URI,
                    Type\PerpetualInterface::FIELD_NAME_WORKER_METHOD,
                ],
                Type\PerpetualInterface::INDEX_NAME_COVERING
            )
        );

        $this->_setSchemaChanges($createTable);

        return $this;
    }
}