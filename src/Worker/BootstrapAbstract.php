<?php
declare(strict_types=1);

namespace NHDS\Jobs\Worker;

use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\Db\Connection\Container;
use NHDS\Jobs\Foreman;

abstract class BootstrapAbstract implements BootstrapInterface
{
    use Container\AwareTrait;
    use Foreman\AwareTrait;
    use Strict\AwareTrait;
    const PROP_PDO = 'pdo';

    abstract public function instantiate(): BootstrapInterface;

    public function setPdo(\PDO $pdo): BootstrapInterface
    {
        $this->_create(self::PROP_PDO, $pdo);
        $this->_getDbConnectionContainer('job')->setPdo($pdo);

        return $this;
    }
}