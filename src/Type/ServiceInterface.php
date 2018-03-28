<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Type;

use Neighborhoods\Kojo\Data\Job\TypeInterface;

interface ServiceInterface
{
    public function setJobType(TypeInterface $jobType);

    public function save();
}