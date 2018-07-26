<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db;

use Neighborhoods\Kojo\Db\Schema\VersionInterface;

interface TearDownInterface
{
    public function uninstall(): TearDownInterface;

    public function addVersion(VersionInterface $version): TearDownInterface;
}