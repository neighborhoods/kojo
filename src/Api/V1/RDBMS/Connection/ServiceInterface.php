<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\RDBMS\Connection;

interface ServiceInterface
{
    public function usePDO(\PDO $PDO): ServiceInterface;
}
