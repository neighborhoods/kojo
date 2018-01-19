<?php
declare(strict_types=1);

namespace NHDS\Watch\TestCase;

use NHDS\Watch\Fixture\Expression\Value;
use NHDS\Toolkit\Data\Property\Strict;

class Service implements ServiceInterface
{
    use Strict\AwareTrait;
    use Value\AwareTrait;
}