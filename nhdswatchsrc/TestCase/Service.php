<?php
declare(strict_types=1);

namespace Neighborhoods\Scaffolding\TestCase;

use Neighborhoods\Scaffolding\Fixture\Expression\Value;
use Neighborhoods\Toolkit\Data\Property\Strict;

class Service implements ServiceInterface
{
    use Strict\AwareTrait;
    use Value\AwareTrait;
}