<?php

namespace NHDS\Jobs\Data\Job;

use NHDS\Jobs\Data\Job;
use NHDS\Toolkit\Data\Property\Crud;

abstract class AbstractService implements ServiceInterface
{
    use Crud\AwareTrait;
    use Job\AwareTrait;
    use State\Service\AwareTrait;
    use Job\Type\AwareTrait;
    const PROP_SAVED = 'saved';

    abstract public function save();
}