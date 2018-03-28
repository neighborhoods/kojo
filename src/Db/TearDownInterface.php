<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Db;

interface TearDownInterface
{
    public function uninstall(): TearDownInterface;
}