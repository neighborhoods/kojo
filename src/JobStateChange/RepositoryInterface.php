<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange;

use Doctrine\DBAL\Connection;
use Neighborhoods\Kojo\JobStateChangeInterface;

interface RepositoryInterface
{
    public const TABLE_NAME = 'kojo_job_state_changelog';

    public function insertUsingConnection(JobStateChangeInterface $jobStateChange, Connection $connection) : RepositoryInterface;

    public function selectBatch(int $batchSize) : MapInterface;

    public function deleteBatch(int ...$ids) : RepositoryInterface;
}
