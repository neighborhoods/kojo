<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\State\Service;

use Neighborhoods\Kojo\State\ServiceInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create(): ServiceInterface;
}
