<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\State\Service;

use Neighborhoods\Kojo\State\ServiceInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): ServiceInterface
    {
        return clone $this->getStateService();
    }
}
