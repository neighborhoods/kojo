<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db;

use Neighborhoods\Kojo\Db\Schema;
use Neighborhoods\Kojo\Db\Schema\Version;

class Setup implements SetupInterface
{
    use Version\AwareTrait;

    public function install(): SetupInterface
    {
        /** @var Schema\VersionInterface $version */
        foreach ($this->_getVersions() as $version) {
            $version->applySchemaSetupChanges();
        }

        return $this;
    }
}