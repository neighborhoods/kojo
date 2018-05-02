<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Foreman;

use Neighborhoods\Kojo\ForemanInterface;

trait AwareTrait
{
    public function setForeman(ForemanInterface $foreman)
    {
        $this->_create(ForemanInterface::class, $foreman);

        return $this;
    }

    protected function _getForeman(): ForemanInterface
    {
        return $this->_read(ForemanInterface::class);
    }
}