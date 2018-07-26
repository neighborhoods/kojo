<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db;

use Neighborhoods\Kojo\Db;
use Neighborhoods\Kojo\Db\Schema\Version\MapInterface;
use Neighborhoods\Kojo\Db\Schema\VersionInterface;

class TearDown implements TearDownInterface
{
    use Db\Schema\Version\Map\AwareTrait;

    public function uninstall(): TearDownInterface
    {
        foreach ($this->getVersions() as $version) {
            $version->applySchemaTearDownChanges();
        }

        return $this;
    }

    public function addVersion(VersionInterface $version): TearDownInterface
    {
        $this->getDbSchemaVersionMap()->append($version);

        return $this;
    }

    protected function getVersions(): MapInterface
    {
        return $this->getDbSchemaVersionMap();
    }
}