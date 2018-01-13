<?php

namespace NHDS\Jobs\Process;

use NHDS\Jobs\ProcessAbstract;

abstract class ListenerAbstract extends ProcessAbstract implements ListenerInterface
{
    use Collection\AwareTrait;
}