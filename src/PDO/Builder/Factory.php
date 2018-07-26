<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\PDO\Builder;

use Neighborhoods\Kojo\PDO\BuilderInterface;

/** @codeCoverageIgnore */
class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): BuilderInterface
    {
        return clone $this->getPDOBuilder();
    }
}