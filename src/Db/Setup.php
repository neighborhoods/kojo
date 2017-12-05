<?php

namespace NHDS\Jobs\Db;

use NHDS\Jobs\Db\Schema;
use NHDS\Jobs\Db\Schema\Version;

class Setup implements SetupInterface
{
    use Version\AwareTrait;

    public function install(): SetupInterface
    {
        /** @var Schema\VersionInterface $version */
        foreach ($this->_getVersions() as $version) {
            try{
                $version->assembleSchemaChanges();
                $version->applySchemaChanges();
            }catch(\Exception $exception){
                echo $exception->getMessage();
            }
        }

        return $this;
    }
}