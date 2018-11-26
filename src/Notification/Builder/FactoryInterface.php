<?php

namespace Neighborhoods\Kojo\Notification\Builder;

/**
 * @codeCoverageIgnore
 */
interface FactoryInterface
{

    public function create() : \Neighborhoods\Kojo\Notification\BuilderInterface;

}

