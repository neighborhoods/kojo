<?php

namespace NHDS\Jobs\Data\Job\Type\Collection;

use NHDS\Jobs\Data\Job\Type\Collection;
use NHDS\Toolkit\Data\Property\Crud;

class Service implements ServiceInterface
{
    use Collection\AwareTrait;
    use Crud\AwareTrait;
    protected $_namedCollections = [];

    public function getNamedCollection(string $collectionName): Collection
    {
        if (isset($this->_namedCollections[$collectionName])) {
            $namedCollection = $this->_namedCollections[$collectionName];
        }else {
            $namedCollection = $this->_getCollectionClone();
        }

        return $namedCollection;
    }
}