<?php
declare(strict_types=1);

namespace NHDS\Jobs\Db;

use NHDS\Jobs\Db\Schema;
use NHDS\Jobs\Db\Schema\Version;
use Zend\Db\Adapter\Exception\InvalidQueryException;

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
            }catch(InvalidQueryException $invalidQueryException){
                $message = $invalidQueryException->getMessage();
                if (strpos($message, 'already exists') === false) {
                    throw $invalidQueryException;
                }
                echo $message . "\n";
            }
        }

        return $this;
    }
}