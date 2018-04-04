<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal\Information\Collection;

use Neighborhoods\Kojo\Process\Signal\Information\CollectionInterface;

trait AwareTrait
{
    public function setProcessSignalInformationCollection(CollectionInterface $processSignalInformationCollection): self
    {
        $this->_create(CollectionInterface::class, $processSignalInformationCollection);

        return $this;
    }

    protected function _getProcessSignalInformationCollection(): CollectionInterface
    {
        return $this->_read(CollectionInterface::class);
    }

    protected function _getProcessSignalInformationCollectionClone(): CollectionInterface
    {
        return clone $this->_getProcessSignalInformationCollection();
    }

    protected function _hasProcessSignalInformationCollection(): bool
    {
        return $this->_exists(CollectionInterface::class);
    }

    protected function _unsetProcessSignalInformationCollection(): self
    {
        $this->_delete(CollectionInterface::class);

        return $this;
    }
}