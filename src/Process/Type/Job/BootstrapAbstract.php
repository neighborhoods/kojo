<?php

namespace NHDS\Jobs\Process\Type\Job;

use NHDS\Jobs\Db\Connection\Container;
use NHDS\Jobs\Foreman;

abstract class BootstrapAbstract implements BootstrapInterface
{
    use Container\AwareTrait;
    use Foreman\AwareTrait;
}