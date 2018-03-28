<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Exception\Runtime\Filesystem;

use Neighborhoods\Kojo\Exception\Runtime\Filesystem;

trait AwareTrait
{
    protected function _throwNewFilesystemException($code)
    {
        $fileSystemException = new Filesystem();
        $fileSystemException->setCode($code);
        throw $fileSystemException;
    }
}