<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db;

use Neighborhoods\Kojo\Db\Schema;
use Neighborhoods\Kojo\Db\Schema\Version;

class TearDown implements TearDownInterface
{
    use Version\AwareTrait;

    public function uninstall(): TearDownInterface
    {
        /** @var Schema\VersionInterface $version */
        foreach ($this->_getVersions() as $version) {
            $version->applySchemaTearDownChanges();
        }

        return $this;
    }
}