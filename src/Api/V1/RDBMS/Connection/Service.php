<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\RDBMS\Connection;

use Neighborhoods\Kojo\Doctrine;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorInterface;
use Neighborhoods\Pylon\Data;

class Service implements ServiceInterface
{
    use Data\Property\Defensive\AwareTrait;
    use Doctrine\Connection\Decorator\Repository\AwareTrait;
    use Doctrine\Connection\Decorator\Factory\AwareTrait;

    public function usePDO(\PDO $PDO): ServiceInterface
    {
        $replacementDecorator = $this->_getDoctrineConnectionDecoratorFactory()->create();
        $replacementDecorator->setId(DecoratorInterface::ID_JOB)->setPDO($PDO);
        $this->_getDoctrineConnectionDecoratorRepository()->replace($replacementDecorator);

        return $this;
    }
}
