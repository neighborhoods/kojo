<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Data\Job;
use Neighborhoods\Pylon\Data\Property\Defensive;

abstract class ServiceAbstract implements ServiceInterface
{
    use Defensive\AwareTrait;
    use Job\AwareTrait;
    use State\Service\AwareTrait;
    const PROP_SAVED = 'saved';

    public function save(): ServiceInterface
    {
        if ($this->_exists(self::PROP_SAVED)) {
            throw new \LogicException('The service has already saved the job.');
        }
        $this->_save();
        $this->_create(self::PROP_SAVED, true);

        return $this;
    }

    abstract protected function _save();
}