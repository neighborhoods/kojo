<?php

namespace NHDS\Watch\TestCase;

use NHDS\Watch\Fixture\Expression\Value;
use NHDS\Toolkit\Container;

class Service implements ServiceInterface
{
    use Container\AwareTrait;
    use Value\AwareTrait;
}