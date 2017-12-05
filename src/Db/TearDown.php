<?php

namespace NHDS\Jobs\Db;

use NHDS\Jobs\Db\Schema;
use NHDS\Jobs\Db\Schema\Version;

class TearDown implements TearDownInterface
{
    use Version\AwareTrait;

    public function uninstall(): TearDownInterface
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