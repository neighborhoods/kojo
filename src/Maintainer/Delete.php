<?php
declare(strict_types=1);

namespace NHDS\Jobs\Maintainer;

use NHDS\Jobs\Data\Job;
use NHDS\Toolkit\Data\Property\Strict;
use NHDS\Jobs\Semaphore;
use NHDS\Jobs\Process\Pool\Logger;

class Delete implements DeleteInterface
{
    use Strict\AwareTrait;
    use Semaphore\AwareTrait;
    use Semaphore\Resource\Factory\AwareTrait;
    use Job\Collection\Delete\AwareTrait;
    use Logger\AwareTrait;
    const PROP_PAGE_SIZE = 'page_size';
    const PROP_OFFSET    = 'offset';
    protected $_collectionIterations = 0;

    public function deleteCompletedJobs(): DeleteInterface
    {
        if ($this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_MAINTAINER_DELETE)->testAndSetLock()) {
            try{
                $this->_deleteCompletedJobs();
                $this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_MAINTAINER_DELETE)->releaseLock();
            }catch(\Exception $exception){
                $this->_getLogger()->debug('Received Exception with message "' . $exception->getMessage() . '"');
                if ($this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_MAINTAINER_DELETE)->hasLock()) {
                    $this->_getSemaphoreResource(self::SEMAPHORE_RESOURCE_NAME_MAINTAINER_DELETE)->releaseLock();
                }
                throw $exception;
            }
        }

        return $this;
    }

    protected function _deleteCompletedJobs(): DeleteInterface
    {
        $select = $this->_getJobCollectionDelete()->getSelect();
        $select->offset($this->_collectionIterations * $this->_getPageSize());
        $select->limit($this->_getPageSize());
        $jobCandidates = $this->_getJobCollectionDelete()->getModelsArray();

        while (!empty($jobCandidates)) {
            foreach ($this->_getJobCollectionDelete()->getIterator() as $jobCandidate) {
                $jobCandidate->delete();
            }
            ++$this->_collectionIterations;
            $select->offset($this->_collectionIterations * $this->_getPageSize());
            $jobCandidates = $this->_getJobCollectionDelete()->getRecords();
        }

        return $this;
    }

    protected function _getPageSize(): int
    {
        return $this->_read(self::PROP_PAGE_SIZE);
    }

    public function setPageSize(int $pageSize): DeleteInterface
    {
        $this->_create(self::PROP_PAGE_SIZE, $pageSize);

        return $this;
    }

    protected function _getOffset(): int
    {
        return $this->_read(self::PROP_OFFSET);
    }

    public function setOffset(int $offset): DeleteInterface
    {
        $this->_create(self::PROP_OFFSET, $offset);

        return $this;
    }
}