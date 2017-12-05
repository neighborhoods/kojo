<?php

namespace NHDS\Jobs\Db\Connection\Container;

use NHDS\Jobs\Db\Connection\ContainerInterface;

trait AwareTrait
{
    protected $_dbConnectionContainers = [];

    public function addDbConnectionContainer(ContainerInterface $container)
    {
        $containerName = $container->getName();
        if (isset($this->_dbConnectionContainers[$containerName])) {
            throw new \LogicException('The container [' . $containerName . '] is already set.');
        }

        $this->_dbConnectionContainers[$container->getName()] = $container;

        return $this;
    }

    protected function _getDbConnectionContainer(string $containerName): ContainerInterface
    {
        if (!isset($this->_dbConnectionContainers[$containerName])) {
            throw new \LogicException('The container [' . $containerName . '] is not set.');
        }

        return $this->_dbConnectionContainers[$containerName];
    }
}