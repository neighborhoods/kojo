<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo\Process;

use Neighborhoods\Kojo\Semaphore;
use Neighborhoods\Kojo\JobStateChange;

class JobStateChangelogProcessor extends Forked implements JobStateChangelogProcessorInterface
{
    use Semaphore\Resource\Factory\AwareTrait;
    use JobStateChange\Repository\AwareTrait;

    public const TYPE_CODE = 'job_state_changelog_processor';

    protected $batchSize;
    protected $numMaxIterations;

    protected function _run(): Forked
    {
        $this->_getLogger()->debug('JobStateChangelogProcessor has been instantiated');
        $semaphoreResource = $this->_getSemaphoreResource(self::TYPE_CODE);

        if ($semaphoreResource->testAndSetLock()) {
            $this->_getLogger()->debug('JobStateChangelogProcessor has acquired mutex');
            $this->businessLogic();
            $semaphoreResource->releaseLock();
        } else {
            $this->_getLogger()->debug('JobStateChangelogProcessor failed to acquire mutex');
        }

        return $this;
    }

    protected function businessLogic() : JobStateChangelogProcessorInterface
    {
        $jobStateChangeRepo = $this->getJobStateChangeRepository();
        $logger = $this->_getLogger();
        $iterationCount = 0;

        while (
            $iterationCount < $this->getNumMaxIterations() &&
            // empty() doesn't work on Maps
            ($jobStateChanges = $jobStateChangeRepo->selectBatch($this->getBatchSize()))->count() !== 0
        ) {
            foreach ($jobStateChanges as $jobStateChange) {
                $logger->info('Job state change', $jobStateChange->jsonSerialize());
            }

            $jobStateChangeRepo->deleteBatch(...array_keys($jobStateChanges->toArray()));
            $iterationCount++;
        }

        $this->_getLogger()->debug("JobStateChangelogProcessor completed $iterationCount iterations", [
            'iteration_count' => $iterationCount,
            'event_type' => 'job_state_changelog_processor_bow_out'
        ]);

        return $this;
    }

    public function getBatchSize() : int
    {
        if ($this->batchSize === null) {
            throw new \LogicException('JobStateChangelogProcessor batchSize has not been set.');
        }
        return $this->batchSize;
    }

    public function setBatchSize(int $batchSize) : JobStateChangelogProcessorInterface
    {
        if ($this->batchSize !== null) {
            throw new \LogicException('JobStateChangelogProcessor batchSize is already set.');
        }
        $this->batchSize = $batchSize;
        return $this;
    }

    protected function getNumMaxIterations() : int
    {
        if ($this->numMaxIterations === null) {
            throw new \LogicException('JobStateChangelogProcessor numMaxIterations has not been set.');
        }
        return $this->numMaxIterations;
    }

    public function setNumMaxIterations(int $numMaxIterations) : JobStateChangelogProcessorInterface
    {
        if ($this->numMaxIterations !== null) {
            throw new \LogicException('JobStateChangelogProcessor numMaxIterations is already set.');
        }
        $this->numMaxIterations = $numMaxIterations;
        return $this;
    }
}
