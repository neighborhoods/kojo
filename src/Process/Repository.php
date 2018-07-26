<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Process;
use Neighborhoods\Kojo\ProcessInterface;

class Repository implements RepositoryInterface
{
    use Process\Factory\Map\AwareTrait;
    use Process\Map\Factory\AwareTrait;

    public function create(string $id): ProcessInterface
    {
        return $this->getProcessFactoryMap()[$id]->create();
    }

    public function getAll(): MapInterface
    {
        $processMap = $this->getProcessMapFactory()->create();
        foreach ($this->getProcessFactoryMap() as $processFactory) {
            $processMap->append($processFactory->create());
        }

        return $processMap;
    }
}