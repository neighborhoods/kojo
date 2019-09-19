<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\StateTransitionChange;

interface RepositoryInterface
{
    public const TABLE_NAME = 'kojo_state_transition_changelog';

    public function selectBatch(int $batchSize) : MapInterface;

    public function deleteBatch(int ...$ids) : RepositoryInterface;
}
