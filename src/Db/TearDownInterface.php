<?php

namespace NHDS\Jobs\Db;

interface TearDownInterface
{
    public function uninstall(): TearDownInterface;
}