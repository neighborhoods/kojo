<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Api\V1\Job\Type;

interface ServiceInterface
{
    public function getNewJobTypeRegistrar(): RegistrarInterface;
}