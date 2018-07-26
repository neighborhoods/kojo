<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db;

use Neighborhoods\Kojo\Db;
use Neighborhoods\Kojo\Db\Schema\Version\MapInterface;
use Neighborhoods\Kojo\Db\Schema\VersionInterface;

class Setup implements SetupInterface
{
    use Db\Schema\Version\Map\AwareTrait;

    public function install(): SetupInterface
    {
        foreach ($this->getVersions() as $version) {
            $version->applySchemaSetupChanges();
        }

        return $this;
    }

    public function addVersion(VersionInterface $version): SetupInterface
    {
        $this->getDbSchemaVersionMap()->append($version);

        return $this;
    }

    protected function getVersions(): MapInterface
    {
        return $this->getDbSchemaVersionMap();
    }
}