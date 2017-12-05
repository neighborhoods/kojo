<?php

namespace NHDS\Jobs;

class Maintainer implements MaintainerInterface
{
    public function maintain(): MaintainerInterface
    {
        return $this;
    }
}