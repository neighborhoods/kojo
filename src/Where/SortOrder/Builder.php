<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Where\SortOrder;

use Neighborhoods\Kojo\Where\SortOrderInterface;
use Neighborhoods\Kojo\Where;

class Builder implements BuilderInterface
{
    use Where\SortOrder\Factory\AwareTrait;

    public function build(): SortOrderInterface
    {
        // TODO: Implement build() method.
        throw new \LogicException('Unimplemented build method.');
    }

    public function setfrom(array $from): BuilderInterface
    {
        return $this;
    }

    protected function getFrom(): array
    {

    }
}
