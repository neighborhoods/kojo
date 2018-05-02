<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Setup\Schema;

use Neighborhoods\Kojo\Db\Schema\VersionAbstract;
use Neighborhoods\Kojo\Db\Schema\VersionInterface;
use Neighborhoods\Kojo\Data\Job\Type;
use Zend\Db\Sql\Ddl\Column\BigInteger;
use Zend\Db\Sql\Ddl\Column\Boolean;
use Zend\Db\Sql\Ddl\Column\Integer;
use Zend\Db\Sql\Ddl\Column\Varchar;
use Zend\Db\Sql\Ddl\Constraint\PrimaryKey;
use Zend\Db\Sql\Ddl\Constraint\UniqueKey;
use Zend\Db\Sql\Ddl\CreateTable;
use Zend\Db\Sql\Ddl\Index\Index;

class Version_4_0_0 extends VersionAbstract
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $createTable = new CreateTable(Type::TABLE_NAME);
        $createTable->addColumn(
            new BigInteger(
                Type::FIELD_NAME_ID, false, null,
                [
                    'comment'  => 'The unique ID of this Job type.',
                    'identity' => true,
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Varchar(
                Type::FIELD_NAME_TYPE_CODE, 255, false, null,
                [
                    'comment' => 'The unique code of this Job type.',
                ]));
        $createTable->addColumn(
            new Varchar(
                Type::FIELD_NAME_NAME, 255, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Varchar(
                Type::FIELD_NAME_WORKER_URI, 255, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Varchar(
                Type::FIELD_NAME_WORKER_METHOD, 255, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Boolean(
                Type::FIELD_NAME_CAN_WORK_IN_PARALLEL, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Integer(
                Type::FIELD_NAME_DEFAULT_IMPORTANCE, false, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Varchar(
                Type::FIELD_NAME_CRON_EXPRESSION, 255, true, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Integer(
                Type::FIELD_NAME_SCHEDULE_LIMIT, true, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Integer(
                Type::FIELD_NAME_SCHEDULE_LIMIT_ALLOWANCE, true, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Boolean(
                Type::FIELD_NAME_IS_ENABLED, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Boolean(
                Type::FIELD_NAME_AUTO_COMPLETE_SUCCESS, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Varchar(
                Type::FIELD_NAME_AUTO_DELETE_INTERVAL_DURATION, 255, false, null,
                [
                    'comment' => 'A ISO 8601 interval duration that describes duration of time past a Job\'s'
                        . ' completed_at_date_time that a Job record of this Job Type should be deleted from storage.',
                ]));
        $createTable->addConstraint(new PrimaryKey(Type::FIELD_NAME_ID, Type::FIELD_NAME_ID));
        $createTable->addConstraint(new UniqueKey(Type::FIELD_NAME_TYPE_CODE, Type::FIELD_NAME_TYPE_CODE));
        $createTable->addConstraint(
            new Index(
                [
                    Type::FIELD_NAME_IS_ENABLED,
                    Type::FIELD_NAME_CRON_EXPRESSION,
                    Type::FIELD_NAME_TYPE_CODE,
                    Type::FIELD_NAME_DEFAULT_IMPORTANCE,
                    Type::FIELD_NAME_SCHEDULE_LIMIT,
                    Type::FIELD_NAME_SCHEDULE_LIMIT_ALLOWANCE,
                ],
                Type::INDEX_NAME_SCHEDULER_COVERING
            )
        );
        $createTable->addConstraint(
            new Index(
                [
                    Type::FIELD_NAME_IS_ENABLED,
                    Type::FIELD_NAME_TYPE_CODE,
                    Type::FIELD_NAME_CRON_EXPRESSION,
                    Type::FIELD_NAME_WORKER_URI,
                    Type::FIELD_NAME_WORKER_METHOD,
                    Type::FIELD_NAME_CAN_WORK_IN_PARALLEL,
                    Type::FIELD_NAME_DEFAULT_IMPORTANCE,
                    Type::FIELD_NAME_SCHEDULE_LIMIT,
                    Type::FIELD_NAME_SCHEDULE_LIMIT_ALLOWANCE,
                    Type::FIELD_NAME_AUTO_COMPLETE_SUCCESS,
                    Type::FIELD_NAME_AUTO_DELETE_INTERVAL_DURATION,
                ],
                Type::INDEX_NAME_COVERING
            )
        );

        $this->_setSchemaChanges($createTable);

        return $this;
    }
}