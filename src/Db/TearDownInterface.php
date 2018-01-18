<?php
declare(strict_types=1);

namespace NHDS\Jobs\Db;

interface TearDownInterface
{
    public function uninstall(): TearDownInterface;
}