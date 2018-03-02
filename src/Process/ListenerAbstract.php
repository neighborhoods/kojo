<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process;

use NHDS\Jobs\Message\Broker;

abstract class ListenerAbstract extends Forked implements ListenerInterface
{
    use Collection\AwareTrait;
    use Broker\Type\Collection\AwareTrait;
}