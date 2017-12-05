<?php

namespace NHDS\Jobs\Db\Model;

use NHDS\Jobs\Db\ModelInterface;

trait AwareTrait
{
    public function setModel(ModelInterface $model)
    {
        $this->_create(ModelInterface::class, $model);

        return $this;
    }

    protected function _getModel(): ModelInterface
    {
        return $this->_read(ModelInterface::class);
    }

    protected function _getModelClone(): ModelInterface
    {
        return clone $this->_getModel();
    }
}