<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job;

use Neighborhoods\Kojo\JobInterface;

class Repository implements RepositoryInterface
{
    use Factory\AwareTrait;
    use Map\AwareTrait;
    use Map\Factory\AwareTrait;
    use Builder\Factory\AwareTrait;

    public function create(): JobInterface
    {
        return $this->getJobFactory()->create();
    }

    public function createBuilder(): BuilderInterface
    {
        return $this->getJobBuilderFactory()->create();
    }

    public function get(int $id): JobInterface
    {

    }

    public function save(JobInterface $job): Repository
    {

    }

    public function getWorkingMap(): MapInterface
    {

    }

    public function getDeleteMap(): MapInterface
    {

    }

    public function getScheduledMap(): MapInterface
    {

    }

    public function getSchedulerMap(): MapInterface
    {

    }

    public function getScheduleLimitCheckMap(): MapInterface
    {

    }

    public function getSelectorMap(): MapInterface
    {

    }
}