<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\PDO\Builder;

use Neighborhoods\Kojo\Db\PDO\BuilderInterface;

trait AwareTrait
{
    public function setDbPDOBuilder(BuilderInterface $dbPDOBuilder): self
    {
        $this->_create(BuilderInterface::class, $dbPDOBuilder);

        return $this;
    }

    protected function _getDbPDOBuilder(): BuilderInterface
    {
        return $this->_read(BuilderInterface::class);
    }

    protected function _getDbPDOBuilderClone(): BuilderInterface
    {
        return clone $this->_getDbPDOBuilder();
    }

    protected function _hasDbPDOBuilder(): bool
    {
        return $this->_exists(BuilderInterface::class);
    }

    protected function _unsetDbPDOBuilder(): self
    {
        $this->_delete(BuilderInterface::class);

        return $this;
    }
}