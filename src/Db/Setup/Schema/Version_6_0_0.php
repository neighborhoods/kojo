<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Setup\Schema;

use Neighborhoods\Kojo\Data\AutoSchedule\SqsInterface;
use Neighborhoods\Kojo\Db\Schema\VersionAbstract;
use Neighborhoods\Kojo\Db\Schema\VersionInterface;
use Zend\Db\Sql\Ddl\Column\BigInteger;
use Zend\Db\Sql\Ddl\Column\Varchar;
use Zend\Db\Sql\Ddl\Constraint\PrimaryKey;
use Zend\Db\Sql\Ddl\CreateTable;
use Zend\Db\Sql\Ddl\Index\Index;

class Version_6_0_0 extends VersionAbstract
{
    public function assembleSchemaChanges(): VersionInterface
    {
        $createTable = new CreateTable(SqsInterface::TABLE_NAME);
        $createTable->addColumn(
            new BigInteger(
                SqsInterface::FIELD_NAME_ID, false, null,
                [
                    'comment'  => 'The unique ID of this sqs auto-schedule record.',
                    'identity' => true,
                    'unsigned' => true,
                ]));
        $createTable->addColumn(
            new Varchar(
                SqsInterface::FIELD_NAME_JOB_TYPE_CODE, 255, false, null,
                [
                    'comment' => 'The job type code to which this auto-schedule record relates.',
                ]));
        $createTable->addColumn(
            new Varchar(
                SqsInterface::FIELD_NAME_SQS_QUEUE_NAME, 255, false, null,
                [
                    'comment' => 'The SQS queue name to which this auto-schedule record relates.',
                ]));
        $createTable->addConstraint(
            new PrimaryKey(
                SqsInterface::FIELD_NAME_ID,
                SqsInterface::FIELD_NAME_ID
            )
        );
        $createTable->addConstraint(
            new Index(
                [
                    SqsInterface::FIELD_NAME_JOB_TYPE_CODE,
                    SqsInterface::FIELD_NAME_SQS_QUEUE_NAME,
                ],
                SqsInterface::INDEX_NAME_COVERING
            )
        );

        $this->_setSchemaChanges($createTable);

        return $this;
    }
}