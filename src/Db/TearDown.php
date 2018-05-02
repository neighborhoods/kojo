<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db;

use Neighborhoods\Kojo\Db\Schema;
use Neighborhoods\Kojo\Db\Schema\Version;
use Zend\Db\Adapter\Exception\InvalidQueryException;

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
            }catch(InvalidQueryException $invalidQueryException){
                $message = $invalidQueryException->getMessage();
                if (strpos($message, 'Unknown table') === false) {
                    throw $invalidQueryException;
                }
                echo $message . "\n";
            }
        }

        return $this;
    }
}