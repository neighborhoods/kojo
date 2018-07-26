<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Pool\Strategy;

use Neighborhoods\Kojo\Process\Pool\StrategyInterface;

class Repository implements RepositoryInterface
{
    use Factory\AwareTrait;
    use Builder\Map\AwareTrait;

    public function create(string $id): StrategyInterface
    {
        if (!isset($this->getProcessPoolStrategyBuilderMap()[$id])) {
            throw new \LogicException("Builder with ID[$id] is not set.");
        }

        return $this->getProcessPoolStrategyBuilderMap()[$id]->build();
    }

    public function attachBuilder(BuilderInterface $builder): RepositoryInterface
    {
        $this->getProcessPoolStrategyBuilderMap()->append($builder);

        return $this;
    }
}