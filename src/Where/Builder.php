<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where;

use Neighborhoods\Kojo\WhereInterface;
use Neighborhoods\Kojo\Where;

class Builder implements BuilderInterface
{
    use Where\Factory\AwareTrait;

    public function build(): WhereInterface
    {
        // TODO: Implement build() method.
        throw new \LogicException('Unimplemented build method.');
    }

    public function setRecord(array $record): BuilderInterface
    {
        return $this;
    }

    protected function getRecord(): array
    {

    }
}
