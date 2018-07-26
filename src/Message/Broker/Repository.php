<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Message\Broker;

use Neighborhoods\Kojo\Message\BrokerInterface;
use Neighborhoods\Kojo\Process;

class Repository implements RepositoryInterface
{
    use Map\AwareTrait;
    use Process\Registry\AwareTrait;
    use Factory\AwareTrait;

    public function get(string $id): BrokerInterface
    {
        $id .= $this->getProcessRegistry()->getLastRegisteredProcess()->getUuid();
        if (!isset($this->getMessageBrokerMap()[$id])) {
            $this->getMessageBrokerMap()[$id] = $this->getMessageBrokerFactory()->create();
        }

        return $this->getMessageBrokerMap()[$id];
    }
}