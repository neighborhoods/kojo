<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Model\Collection;

use Neighborhoods\Kojo\Db\Model\CollectionInterface;

trait AwareTrait
{
    public function setCollection(CollectionInterface $collection)
    {
        $this->_create(CollectionInterface::class, $collection);

        return $this;
    }

    protected function _getCollection(): CollectionInterface
    {
        return $this->_read(CollectionInterface::class);
    }
}