<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Worker\Locator;

use Neighborhoods\Kojo\Worker\LocatorInterface;

trait AwareTrait
{
    public function setLocator(LocatorInterface $locator)
    {
        $this->_create(LocatorInterface::class, $locator);

        return $this;
    }

    protected function _getLocator(): LocatorInterface
    {
        return $this->_read(LocatorInterface::class);
    }

    protected function _getLocatorClone(): LocatorInterface
    {
        return clone $this->_getLocator();
    }
}