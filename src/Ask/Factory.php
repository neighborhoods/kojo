<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Ask;

use Neighborhoods\Kojo\AskInterface;

class Factory implements FactoryInterface
{
    use AwareTrait;

    public function create(): AskInterface
    {
        return clone $this->getAsk();
    }
}
