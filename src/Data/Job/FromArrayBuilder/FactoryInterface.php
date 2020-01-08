<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Data\Job\FromArrayBuilder;

use Neighborhoods\Kojo\Data\Job\FromArrayBuilderInterface;

/** @codeCoverageIgnore */
interface FactoryInterface
{
    public function create() : FromArrayBuilderInterface;
}
