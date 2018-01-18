<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process\Pool;

use NHDS\Jobs\Process\CollectionInterface;
use NHDS\Jobs\Process\PoolInterface;
use NHDS\Jobs\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setProcessCollection(CollectionInterface $collection);

    public function setProcessPool(PoolInterface $pool);

    public function setProcessPoolStrategy(StrategyInterface $strategy);
}