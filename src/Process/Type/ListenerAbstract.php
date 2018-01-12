<?php

namespace NHDS\Jobs\Process\Type;

use NHDS\Jobs\ProcessAbstract;

abstract class ListenerAbstract extends ProcessAbstract implements ListenerInterface
{
    use Collection\AwareTrait;
}