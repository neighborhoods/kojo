<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange\Data;

use Neighborhoods\Kojo\JobStateChange\DataInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : DataInterface;
}
