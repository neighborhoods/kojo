<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Ask;

use Neighborhoods\Kojo\AskInterface;
use Neighborhoods\Kojo\Ask;
use Neighborhoods\Kojo\Where;

class Builder implements BuilderInterface
{
    use Ask\Factory\AwareTrait;
    use Where\Builder\Factory\AwareTrait;

    protected $from;

    public function build(): AskInterface
    {
        $from = $this->getFrom();
        $ask = $this->getAskFactory()->create();
        $where = $this->getWhereBuilderFactory()->create();
        $where->setFrom($from['where']);
        $ask->setWhere($where->build());
        $ask->setFactoryFQCN($from['factory_fqcns']);
        $ask->setFactoryFQCN($from['builder_fqcns']);
        $ask->setWith($from['with']);

        return $ask;
    }

    protected function getFrom(): array
    {
        if ($this->from === null) {
            throw new \LogicException('Builder from has not been set.');
        }

        return $this->from;
    }

    public function setFrom(array $from): BuilderInterface
    {
        if ($this->from !== null) {
            throw new \LogicException('Builder from is already set.');
        }

        $this->from = $from;

        return $this;
    }
}
