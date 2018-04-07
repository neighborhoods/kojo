<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process\Signal\Information;

use Neighborhoods\Kojo\Service\FactoryAbstract;
use Neighborhoods\Kojo\Process\Signal\Information;
use Neighborhoods\Kojo\Process\Signal\InformationInterface;

class Factory extends FactoryAbstract implements FactoryInterface
{
    use Information\AwareTrait;

    public function create(): InformationInterface
    {
        $signalInformation = $this->_getProcessSignalInformationClone();

        return $signalInformation;
    }
}