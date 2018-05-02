<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db;

use Neighborhoods\Kojo\Db\Schema\VersionInterface;

interface SetupInterface
{
    public function addVersion(VersionInterface $version);

    public function install(): SetupInterface;
}