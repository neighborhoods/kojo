<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Apm\NewRelic;

use Neighborhoods\Kojo\Apm\NewRelicInterface;

trait AwareTrait
{
    public function setApmNewRelic(NewRelicInterface $apmNewRelic): self
    {
        $this->_create(NewRelicInterface::class, $apmNewRelic);

        return $this;
    }

    protected function _getApmNewRelic(): NewRelicInterface
    {
        return $this->_read(NewRelicInterface::class);
    }

    protected function _getApmNewRelicClone(): NewRelicInterface
    {
        return clone $this->_getApmNewRelic();
    }

    protected function _hasApmNewRelic(): bool
    {
        return $this->_exists(NewRelicInterface::class);
    }

    protected function _unsetApmNewRelic(): self
    {
        $this->_delete(NewRelicInterface::class);

        return $this;
    }
}