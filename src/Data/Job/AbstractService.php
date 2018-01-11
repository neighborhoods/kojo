<?php

namespace NHDS\Jobs\Data\Job;

use NHDS\Jobs\Data\Job;
use NHDS\Toolkit\Data\Property\Strict;

abstract class AbstractService implements ServiceInterface
{
    use Strict\AwareTrait;
    use Job\AwareTrait;
    use State\Service\AwareTrait;
    const PROP_SAVED = 'saved';

    abstract public function save();
}