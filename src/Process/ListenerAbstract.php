<?php
declare(strict_types=1);

namespace NHDS\Jobs\Process;

abstract class ListenerAbstract extends Forkable implements ListenerInterface
{
    use Collection\AwareTrait;
}