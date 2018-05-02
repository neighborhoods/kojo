<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Type;

use Neighborhoods\Kojo\Data\Job;
use Neighborhoods\Pylon\Data\Property\Defensive;
use Neighborhoods\Kojo\Data\Job\TypeInterface;

class Repository implements RepositoryInterface
{
    use Defensive\AwareTrait;
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