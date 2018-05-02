<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db\Connection\Container;

use Neighborhoods\Kojo\Db\Connection\ContainerInterface;
use Neighborhoods\Pylon\Data\Property\Defensive;

class Repository implements RepositoryInterface
{
    use Defensive\AwareTrait;
    use Factory\AwareTrait;
    protected $_containerCollection = [];

    public function get(string $id): ContainerInterface
    {
        if (!isset($this->_containerCollection[$id])) {
            throw new \LogicException("Container with ID[$id] is not set.");
        }

        return $this->_containerCollection[$id];
    }

    public function add(ContainerInterface $container): RepositoryInterface
    {
        $id = $container->getId();
        if (isset($this->_containerCollection[$id])) {
            throw new \LogicException("Container with ID[$id] is already set.");
        }
        $this->_containerCollection[$id] = $container;

        return $this;
    }

    public function create(string $id): ContainerInterface
    {
        if (isset($this->_containerCollection[$id])) {
            throw new \LogicException("Container with ID[$id] is already set.");
        }

        return $this->_containerCollection[$id] = $this->_getDbConnectionContainerFactory()->create()->setId($id);
    }
}