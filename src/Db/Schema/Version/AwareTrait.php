<?php
declare(strict_types=1);

namespace NHDS\Jobs\Db\Schema\Version;

use NHDS\Jobs\Db\Schema\VersionInterface;

trait AwareTrait
{
    protected $versions = [];

    public function addVersion(VersionInterface $version)
    {
        if (isset($this->versions[get_class($version)])) {
            throw new \LogicException('The version [' . get_class($version) . '] is already set.');
        }

        $this->versions[get_class($version)] = $version;

        return $this;
    }

    protected function _getVersions(): array
    {
        return $this->versions;
    }
}