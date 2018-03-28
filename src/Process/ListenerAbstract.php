<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Message\Broker;

abstract class ListenerAbstract extends Forked implements ListenerInterface
{
    use Collection\AwareTrait;
    use Broker\Type\Collection\AwareTrait;
}