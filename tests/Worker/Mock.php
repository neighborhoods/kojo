<?php
declare(strict_types=1);

namespace NHDS\Jobs\Test\Worker;

class Mock
{
    public function work()
    {
        return $this;
    }
}