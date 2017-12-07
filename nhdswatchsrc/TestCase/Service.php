<?php

namespace NHDS\Watch\TestCase;

use NHDS\Watch\Fixture\Expression\Value;
use NHDS\Toolkit\Data\Property\Crud;

class Service implements ServiceInterface
{
    use Crud\AwareTrait;
    use Value\AwareTrait;
}