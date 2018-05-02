<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool;

use Neighborhoods\Kojo\Process\CollectionInterface;
use Neighborhoods\Kojo\Process\PoolInterface;
use Neighborhoods\Kojo\Service;

interface FactoryInterface extends Service\FactoryInterface
{
    public function setProcessCollection(CollectionInterface $collection);

    public function setProcessPool(PoolInterface $pool);

    public function setProcessPoolStrategy(StrategyInterface $strategy);
}