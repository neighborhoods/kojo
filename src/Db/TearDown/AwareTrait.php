<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\TearDown;

use Neighborhoods\Kojo\Db\TearDownInterface;

trait AwareTrait
{
    public function setDbTearDown(TearDownInterface $tearDown)
    {
        $this->_create(TearDownInterface::class, $tearDown);

        return $this;
    }

    protected function _getDbTearDown(): TearDownInterface
    {
        return $this->_read(TearDownInterface::class);
    }

    protected function _getDbTearDownClone(): TearDownInterface
    {
        return clone $this->_getDbTearDown();
    }
}