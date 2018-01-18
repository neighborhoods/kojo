<?php
declare(strict_types=1);

namespace NHDS\Jobs\Maintainer;

use NHDS\Jobs\MaintainerInterface;

trait AwareTrait
{
    public function setMaintainer(MaintainerInterface $scheduler)
    {
        $this->_create(MaintainerInterface::class, $scheduler);

        return $this;
    }

    protected function _getMaintainer(): MaintainerInterface
    {
        return $this->_read(MaintainerInterface::class);
    }
}