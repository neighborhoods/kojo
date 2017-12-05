<?php

namespace NHDS\Jobs\Exception\Runtime\Filesystem;

use NHDS\Jobs\Exception\Runtime\Filesystem;

trait AwareTrait
{
    protected function _throwNewFilesystemException($code)
    {
        $fileSystemException = new Filesystem();
        $fileSystemException->setCode($code);
        throw $fileSystemException;
    }
}