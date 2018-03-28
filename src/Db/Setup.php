<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db;

use Neighborhoods\Kojo\Db\Schema;
use Neighborhoods\Kojo\Db\Schema\Version;
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