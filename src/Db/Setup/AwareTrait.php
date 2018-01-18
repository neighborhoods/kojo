<?php
declare(strict_types=1);

namespace NHDS\Jobs\Db\Setup;

use NHDS\Jobs\Db\SetupInterface;

trait AwareTrait
{
    public function setDbSetup(SetupInterface $setup)
    {
        $this->_create(SetupInterface::class, $setup);

        return $this;
    }

    protected function _getDbSetup(): SetupInterface
    {
        return $this->_read(SetupInterface::class);
    }

    protected function _getDbSetupClone(): SetupInterface
    {
        return clone $this->_getDbSetup();
    }
}