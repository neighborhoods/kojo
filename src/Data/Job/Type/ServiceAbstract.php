<?php
declare(strict_types=1);

namespace NHDS\Jobs\Data\Job\Type;

use NHDS\Jobs\Data\Job;
use NHDS\Toolkit\Data\Property\Strict;

abstract class ServiceAbstract implements Job\Type\ServiceInterface
{
    use Job\Type\AwareTrait;
    use Strict\AwareTrait;
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