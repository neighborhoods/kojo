<?php

namespace NHDS\Jobs\Process\Type;

use NHDS\Jobs\AbstractProcess;
use NHDS\Jobs\Process\Type;

abstract class AbstractListener extends AbstractProcess implements ListenerInterface
{
    use Type\AwareTrait;
}