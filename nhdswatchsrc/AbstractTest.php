<?php

namespace NHDS\Watch;

use PHPUnit\Framework\TestCase;
use NHDS\Toolkit\Data\Property\Crud;
use NHDS\Watch\TestCase\Service;

abstract class AbstractTest extends TestCase
{
    use Crud\AwareTrait;
    use Service\AwareTrait;
}