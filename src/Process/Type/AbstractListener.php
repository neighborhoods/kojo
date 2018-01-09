<?php

namespace NHDS\Jobs\Process\Type;

use NHDS\Jobs\AbstractProcess;

abstract class AbstractListener extends AbstractProcess implements ListenerInterface
{
    use Collection\AwareTrait;
}