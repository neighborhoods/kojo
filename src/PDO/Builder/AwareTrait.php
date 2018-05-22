<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\PDO\Builder;

use Neighborhoods\Kojo\PDO\BuilderInterface;

trait AwareTrait
{
    public function setPDOBuilder(BuilderInterface $dbPDOBuilder): self
    {
        $this->_create(BuilderInterface::class, $dbPDOBuilder);

        return $this;
    }

    protected function _getPDOBuilder(): BuilderInterface
    {
        return $this->_read(BuilderInterface::class);
    }

    protected function _hasPDOBuilder(): bool
    {
        return $this->_exists(BuilderInterface::class);
    }

    protected function _unsetPDOBuilder(): self
    {
        $this->_delete(BuilderInterface::class);

        return $this;
    }
}