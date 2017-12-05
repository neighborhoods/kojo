<?php

namespace NHDS\Jobs\Db;

interface SetupInterface
{
    public function install(): SetupInterface;
}