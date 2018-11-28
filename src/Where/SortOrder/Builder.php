<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\SortOrder;

use Neighborhoods\Kojo\Where\SortOrderInterface;
use Neighborhoods\Kojo\Where;

class Builder implements BuilderInterface
{
    use Where\SortOrder\Factory\AwareTrait;

    protected $from;

    public function build(): SortOrderInterface
    {
        $from = $this->getFrom();
        $sortOrder = $this->getWhereSortOrderFactory()->create();
        $sortOrder->setField($from['field']);
        $sortOrder->setDirection($from['direction']);

        return $sortOrder;
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
