<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Maintainer;

use Neighborhoods\Kojo\MaintainerInterface;

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