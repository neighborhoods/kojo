<?php

namespace NHDS\Jobs;

interface MaintainerInterface
{
    public function maintain(): MaintainerInterface;
}