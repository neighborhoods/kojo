<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\JobStateChange;

interface RepositoryInterface
{
    public const TABLE_NAME = 'kojo_job_state_changelog';

    public function selectBatch(int $batchSize) : MapInterface;

    public function deleteBatch(int ...$ids) : RepositoryInterface;
}
