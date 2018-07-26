<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Service\Create\Builder;

use Neighborhoods\Kojo\Service\Create\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): BuilderInterface;
}
