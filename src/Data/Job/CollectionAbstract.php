<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job;

use NHDS\Jobs\Data\Job\Collection\IteratorInterface;
use NHDS\Jobs\Db;
use NHDS\Jobs\Process;

abstract class CollectionAbstract extends Db\Model\CollectionAbstract
{
    use Process\Pool\Logger\AwareTrait;

    public function setIterator(IteratorInterface $iterator)
    {
        $iterator->setCollection($this);
        $this->_create(IteratorInterface::class, $iterator);

        return $this;
    }

    public function getIterator(): IteratorInterface
    {
        return $this->_getIterator()->initialize();
    }

    protected function _getIterator(): IteratorInterface
    {
        return $this->_read(IteratorInterface::class);
    }

    protected function _logSelect(): CollectionAbstract
    {
        if ($this->_hasLogger()) {
            $sql = $this->_getDbConnectionContainer(Db\Connection\ContainerInterface::NAME_JOB)->getSql();
            $this->_getLogger()->debug($sql->buildSqlString($this->getSelect()));
        }

        return $this;
    }
}