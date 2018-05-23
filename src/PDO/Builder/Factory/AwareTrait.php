<?php

declare(strict_types=1);

namespace Neighborhoods\Kojo\PDO\Builder\Factory;

use Neighborhoods\Kojo\PDO\Builder\FactoryInterface;

trait AwareTrait
{
    public function setPDOBuilderFactory(FactoryInterface $dbPDOBuilderFactory): self
    {
        $this->_create(FactoryInterface::class, $dbPDOBuilderFactory);

        return $this;
    }

    protected function _getPDOBuilderFactory(): FactoryInterface
    {
        return $this->_read(FactoryInterface::class);
    }

    protected function _hasPDOBuilderFactory(): bool
    {
        return $this->_exists(FactoryInterface::class);
    }

    protected function _unsetPDOBuilderFactory(): self
    {
        $this->_delete(FactoryInterface::class);

        return $this;
    }
}
