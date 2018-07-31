<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\Process\PoolInterface;
use Neighborhoods\Kojo\Process;

class Repository implements RepositoryInterface
{
    use Process\Pool\Map\AwareTrait;
    use Process\Pool\Factory\AwareTrait;
    use Process\Pool\Strategy\Repository\AwareTrait;

    public function get(string $id): PoolInterface
    {
        if (!isset($this->getProcessPoolMap()[$id])) {
            $processPool = $this->getProcessPoolFactory()->create();
            $processPoolStrategy = $this->getProcessPoolStrategyRepository()->create($id);
            $processPool->setProcessPoolStrategy($processPoolStrategy);
            $processPoolStrategy->setProcessPool($processPool);
            $this->getProcessPoolMap()[$id] = $processPool;
        }

        return $this->getProcessPoolMap()[$id];
    }
}