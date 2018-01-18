<?php
declare(strict_types=1);

namespace NHDS\Jobs\Filesystem;

use Symfony\Component\Filesystem\Filesystem;

trait AwareTrait
{
    protected $_filesystem;

    public function _getFilesystem(): Filesystem
    {
        if ($this->_filesystem === null) {
            $this->_filesystem = new Filesystem();
        }

        return $this->_filesystem;
    }
}