<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Job;

use Neighborhoods\Kojo\JobInterface;

interface RepositoryInterface
{
    public function create(): JobInterface;

    public function createBuilder(): BuilderInterface;

    public function get(int $id): JobInterface;

    public function save(JobInterface $job): Repository;

    public function getWorkingMap(): MapInterface;

    public function getDeleteMap(): MapInterface;

    public function getScheduledMap(): MapInterface;

    public function getSchedulerMap(): MapInterface;

    public function getScheduleLimitCheckMap(): MapInterface;

    public function getSelectorMap(): MapInterface;
}