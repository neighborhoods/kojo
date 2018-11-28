<?php

namespace Neighborhoods\Kojo\Notifier;

/**
 * @codeCoverageIgnore
 */
class Factory implements FactoryInterface
{

    use AwareTrait;

    public function create() : \Neighborhoods\Kojo\NotifierInterface
    {
        return clone $this->getAskNotifier();
    }


}

