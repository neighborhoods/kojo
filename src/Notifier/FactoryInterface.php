<?php

namespace Neighborhoods\Kojo\Notifier;

/**
 * @codeCoverageIgnore
 */
interface FactoryInterface
{

    public function create() : \Neighborhoods\Kojo\NotifierInterface;

}

