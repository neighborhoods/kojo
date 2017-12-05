<?php

namespace NHDS\Jobs\Data\Job;

use NHDS\Jobs\Db\Model\AbstractCollection;
use NHDS\Jobs\Data\Job\Collection\Iterator;

class Collection extends AbstractCollection
{
    use Iterator\AwareTrait;
}