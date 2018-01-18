<?php
declare(strict_types=1);

namespace NHDS\Jobs\Db;

use NHDS\Jobs\Db\Schema\VersionInterface;

interface SetupInterface
{
    public function addVersion(VersionInterface $version);

    public function install(): SetupInterface;
}