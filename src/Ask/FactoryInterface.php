<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Ask;

use Neighborhoods\Kojo\AskInterface;

interface FactoryInterface
{
    public function create(): AskInterface;
}
