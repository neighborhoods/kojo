<?php

namespace NHDS\Jobs\Process\Pool;

interface ServerInterface
{
    public function start(): Server;
}