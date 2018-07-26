<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job\Type;

use Neighborhoods\Kojo\Job;
use Neighborhoods\Kojo\Job\TypeInterface;

class Repository implements RepositoryInterface
{
    use Job\Type\AwareTrait;
    use Job\Type\Factory\AwareTrait;
    use Job\Type\Map\AwareTrait;

    public function create(string $typeCode): TypeInterface
    {
        return $this->getJobTypeFactory()->create();
    }

    public function get(string $typeCode): TypeInterface
    {
        if (!isset($this->getJobTypeMap()[$typeCode])) {
            $jobType = $this->getJobTypeFactory()->create();
            $jobType->load(TypeInterface::FIELD_NAME_TYPE_CODE, $typeCode);
            $this->getJobTypeMap()[$typeCode] = $jobType;
        }

        return $this->getJobTypeMap()[$typeCode];
    }

    public function getAll(): MapInterface
    {

    }
}