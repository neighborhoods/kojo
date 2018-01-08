<?php

namespace NHDS\Jobs\Db\Setup\Schema;

use NHDS\Jobs\Db\Schema\AbstractVersion;
use NHDS\Jobs\Db\Schema\VersionInterface;
use NHDS\Jobs\Data\Job\Type;
use NHDS\Jobs\Data\JobInterface;
use Zend\Db\Metadata\Object\ConstraintKeyObject;
use Zend\Db\Sql\Ddl\Column\BigInteger;
use Zend\Db\Sql\Ddl\Column\Boolean;
use Zend\Db\Sql\Ddl\Column\Datetime;
use Zend\Db\Sql\Ddl\Column\Integer;
use Zend\Db\Sql\Ddl\Column\Varchar;
use Zend\Db\Sql\Ddl\Constraint\ForeignKey;
use Zend\Db\Sql\Ddl\Constraint\PrimaryKey;
use Zend\Db\Sql\Ddl\CreateTable;
use Zend\Db\Sql\Ddl\Index\Index;

class Version_5_0_0 extends AbstractVersion
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $createTable = new CreateTable(JobInterface::TABLE_NAME);
        $createTable->addColumn(
            new BigInteger(
                JobInterface::FIELD_NAME_ID, false, null,
                [
                    'comment'  => 'The unique ID of this job.',
                    'identity' => true,
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Varchar(
                JobInterface::FIELD_NAME_TYPE_CODE, 255, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Varchar(
                JobInterface::FIELD_NAME_NAME, 255, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Integer(
                JobInterface::FIELD_NAME_PRIORITY, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Integer(
                JobInterface::FIELD_NAME_IMPORTANCE, false, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new BigInteger(
                JobInterface::FIELD_NAME_STATUS_ID, true, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Datetime(
                JobInterface::FIELD_NAME_WORK_AT_DATETIME, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Varchar(
                JobInterface::FIELD_NAME_NEXT_STATE_REQUEST, 255, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Varchar(
                JobInterface::FIELD_NAME_ASSIGNED_STATE, 255, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Varchar(
                JobInterface::FIELD_NAME_PREVIOUS_STATE, 255, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Varchar(
                JobInterface::FIELD_NAME_WORKER_URI, 255, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Varchar(
                JobInterface::FIELD_NAME_WORKER_METHOD, 255, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Boolean(
                JobInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL, false, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new Datetime(
                JobInterface::FIELD_NAME_LAST_TRANSITION_DATETIME, true, null,
                [
                    'comment' => 'COMMENT',
                ]));
        $createTable->addColumn(
            new BigInteger(
                JobInterface::FIELD_NAME_LAST_TRANSITION_MICRO_TIME, true, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Integer(
                JobInterface::FIELD_NAME_TIMES_WORKED, false, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Integer(
                JobInterface::FIELD_NAME_TIMES_RETRIED, false, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Integer(
                JobInterface::FIELD_NAME_TIMES_HELD, false, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Integer(
                JobInterface::FIELD_NAME_TIMES_CRASHED, false, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Integer(
                JobInterface::FIELD_NAME_TIMES_PANICKED, false, null,
                [
                    'comment'  => 'COMMENT',
                    'unsigned' => true,
                ]));
        $createTable->addConstraint(new PrimaryKey(JobInterface::FIELD_NAME_ID));
        $createTable->addConstraint(
            new Index(
                [
                    JobInterface::FIELD_NAME_ASSIGNED_STATE,
                    JobInterface::FIELD_NAME_NEXT_STATE_REQUEST,
                    JobInterface::FIELD_NAME_WORK_AT_DATETIME,
                    JobInterface::FIELD_NAME_PRIORITY,
                    JobInterface::FIELD_NAME_TYPE_CODE,
                    JobInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL,
                    JobInterface::FIELD_NAME_PREVIOUS_STATE,
                    JobInterface::FIELD_NAME_TIMES_CRASHED,

                ],
                JobInterface::INDEX_NAME_CRASHED_AND_SELECTION
            )
        );
        $createTable->addConstraint(
            new Index(
                [
                    JobInterface::FIELD_NAME_TYPE_CODE,
                    JobInterface::FIELD_NAME_ASSIGNED_STATE,
                    JobInterface::FIELD_NAME_NEXT_STATE_REQUEST,
                    JobInterface::FIELD_NAME_PRIORITY,
                    JobInterface::FIELD_NAME_CAN_WORK_IN_PARALLEL,
                    JobInterface::FIELD_NAME_PREVIOUS_STATE,
                ],
                JobInterface::INDEX_NAME_PENDING
            )
        );
        $createTable->addConstraint(
            new Index(
                [
                    JobInterface::FIELD_NAME_WORK_AT_DATETIME,
                    JobInterface::FIELD_NAME_TYPE_CODE,
                ],
                JobInterface::INDEX_NAME_SCHEDULER
            )
        );
        $createTable->addConstraint(
            new ForeignKey(
                JobInterface::FOREIGN_KEY_NAME_JOB_TYPE_CODE,
                JobInterface::FIELD_NAME_TYPE_CODE,
                Type::TABLE_NAME,
                Type::FIELD_NAME_TYPE_CODE,
                ConstraintKeyObject::FK_CASCADE,
                ConstraintKeyObject::FK_CASCADE
            )
        );

        $this->_setSchemaChanges($createTable);

        return $this;
    }
}