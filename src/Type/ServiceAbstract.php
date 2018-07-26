<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Type;

use Neighborhoods\Kojo\Type;
use Neighborhoods\Kojo\Job;

abstract class ServiceAbstract implements Type\ServiceInterface
{
    use Job\Type\AwareTrait;
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