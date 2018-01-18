<?php
declare(strict_types=1);

namespace NHDS\Jobs\Db\Setup\Schema;

use NHDS\Jobs\Data\Status\Type;
use NHDS\Jobs\Db\Schema\VersionAbstract;
use NHDS\Jobs\Db\Schema\VersionInterface;
use Zend\Db\Sql\Ddl\Column\BigInteger;
use Zend\Db\Sql\Ddl\Column\Varchar;
use Zend\Db\Sql\Ddl\Constraint\PrimaryKey;
use Zend\Db\Sql\Ddl\CreateTable;
use Zend\Db\Sql\Ddl\Index\Index;

class Version_1_0_0 extends VersionAbstract
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $createTable = new CreateTable(Type::TABLE_NAME);
        $createTable->addColumn(
            new BigInteger(
                Type::FIELD_NAME_ID, false, null,
                [
                    'comment'  => 'The unique ID of this status type.',
                    'identity' => true,
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Varchar(
                Type::FIELD_NAME_CODE, 255, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Varchar(
                Type::FIELD_NAME_NAME, 255, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addConstraint(new PrimaryKey(Type::FIELD_NAME_ID));
        $createTable->addConstraint(new Index(Type::FIELD_NAME_CODE, Type::INDEX_NAME_CODE));

        $this->_setSchemaChanges($createTable);

        return $this;
    }
}