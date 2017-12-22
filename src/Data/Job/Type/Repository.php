<?php

namespace NHDS\Jobs\Data\Job\Type;

use NHDS\Jobs\Data\Job;
use NHDS\Toolkit\Data\Property\Crud;
use NHDS\Jobs\Data\Job\TypeInterface;

class Repository implements RepositoryInterface
{
    use Crud\AwareTrait;
    use Job\Type\AwareTrait;
    protected $_jobTypes = [];

    public function getJobType(string $typeCode): TypeInterface
    {
        if (!isset($this->_jobTypes[$typeCode])) {
            $jobType = $this->_getJobTypeClone();
            $jobType->load(TypeInterface::FIELD_NAME_TYPE_CODE, $typeCode);
            $this->_jobTypes[$typeCode] = $jobType;
        }

        return $this->_jobTypes[$typeCode];
    }

    public function getJobTypeClone(string $typeCode): TypeInterface
    {
        return clone $this->getJobType($typeCode);
    }
}