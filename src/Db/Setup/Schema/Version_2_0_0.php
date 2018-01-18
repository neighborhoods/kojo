<?php

namespace NHDS\Jobs\Db\Setup\Schema;

use NHDS\Jobs\Db\Schema\VersionAbstract;
use NHDS\Jobs\Db\Schema\VersionInterface;
use NHDS\Jobs\Data\Status;
use NHDS\Jobs\Data\Status\Type;
use Zend\Db\Metadata\Object\ConstraintKeyObject;
use Zend\Db\Sql\Ddl\Column\BigInteger;
use Zend\Db\Sql\Ddl\Column\Datetime;
use Zend\Db\Sql\Ddl\Column\Integer;
use Zend\Db\Sql\Ddl\Column\Varchar;
use Zend\Db\Sql\Ddl\Constraint\ForeignKey;
use Zend\Db\Sql\Ddl\Constraint\PrimaryKey;
use Zend\Db\Sql\Ddl\CreateTable;
use Zend\Db\Sql\Ddl\Index\Index;

class Version_2_0_0 extends VersionAbstract
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $createTable = new CreateTable(Status::TABLE_NAME);
        $createTable->addColumn(
            new BigInteger(
                Status::FIELD_NAME_ID, false, null,
                [
                    'comment'  => 'The unique ID of this status.',
                    'identity' => true,
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Datetime(
                Status::FIELD_NAME_STARTED_AT_DATE_TIME, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new BigInteger(
                Status::FIELD_NAME_STARTED_AT_MICRO_TIME, false, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Datetime(
                Status::FIELD_NAME_FINALIZED_AT_DATE_TIME, true, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new BigInteger(
                Status::FIELD_NAME_FINALIZED_AT_MICRO_TIME, true, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Varchar(
                Status::FIELD_NAME_TYPE_CODE, 255, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Varchar(
                Status::FIELD_NAME_STATE, 255, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Integer(
                Status::FIELD_NAME_MESSAGE_COUNT, false, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Integer(
                Status::FIELD_NAME_ERROR_COUNT, true, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Integer(
                Status::FIELD_NAME_MAX_ERROR_LEVEL, true, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addConstraint(new PrimaryKey(Status::FIELD_NAME_ID));
        $createTable->addConstraint(new Index(Status::FIELD_NAME_TYPE_CODE, Status::INDEX_NAME_TYPE_CODE));
        $createTable->addConstraint(
            new ForeignKey(
                Status::FOREIGN_KEY_NAME,
                Status::FIELD_NAME_TYPE_CODE,
                Type::TABLE_NAME,
                Type::FIELD_NAME_CODE,
                ConstraintKeyObject::FK_CASCADE,
                ConstraintKeyObject::FK_CASCADE
            )
        );

        $this->_setSchemaChanges($createTable);

        return $this;
    }
}