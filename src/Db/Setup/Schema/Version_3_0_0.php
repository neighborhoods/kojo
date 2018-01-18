<?php

namespace NHDS\Jobs\Db\Setup\Schema;

use NHDS\Jobs\Db\Schema\VersionAbstract;
use NHDS\Jobs\Db\Schema\VersionInterface;
use NHDS\Jobs\Data\Status;
use NHDS\Jobs\Data\Status\Message;
use Zend\Db\Metadata\Object\ConstraintKeyObject;
use Zend\Db\Sql\Ddl\Column\BigInteger;
use Zend\Db\Sql\Ddl\Column\Datetime;
use Zend\Db\Sql\Ddl\Column\Integer;
use Zend\Db\Sql\Ddl\Column\Text;
use Zend\Db\Sql\Ddl\Constraint\ForeignKey;
use Zend\Db\Sql\Ddl\Constraint\PrimaryKey;
use Zend\Db\Sql\Ddl\CreateTable;
use Zend\Db\Sql\Ddl\Index\Index;

class Version_3_0_0 extends VersionAbstract
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $createTable = new CreateTable(Message::TABLE_NAME);
        $createTable->addColumn(
            new BigInteger(
                Message::FIELD_NAME_ID, false, null,
                [
                    'comment'  => 'The unique ID of this status message.',
                    'identity' => true,
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new BigInteger(
                Message::FIELD_NAME_STATUS_ID, false, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Datetime(
                Message::FIELD_NAME_DATE_TIME, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new BigInteger(
                Message::FIELD_NAME_MICRO_TIME, false, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Integer(
                Message::FIELD_NAME_LEVEL, true, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Text(
                Message::FIELD_NAME_MESSAGE, null, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addConstraint(new PrimaryKey(Message::FIELD_NAME_ID));
        $createTable->addConstraint(new Index(Message::FIELD_NAME_STATUS_ID, Message::INDEX_NAME_STATUS_ID));
        $createTable->addConstraint(
            new ForeignKey(
                Message::FOREIGN_KEY_NAME_STATUS_ID,
                Message::FIELD_NAME_STATUS_ID,
                Status::TABLE_NAME,
                Status::FIELD_NAME_ID,
                ConstraintKeyObject::FK_CASCADE,
                ConstraintKeyObject::FK_CASCADE
            )
        );
        $this->_setSchemaChanges($createTable);

        return $this;
    }
}