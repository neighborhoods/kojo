<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Schema;

interface VersionInterface
{
    public function applySchemaSetupChanges(): VersionInterface;

    public function setTableName(string $tableName): VersionInterface;

    public function applySchemaTearDownChanges(): VersionInterface;
}