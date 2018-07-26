<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\PDO\Builder;

use Neighborhoods\Kojo\PDO\BuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): BuilderInterface;
}