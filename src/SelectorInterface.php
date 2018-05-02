<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

use Neighborhoods\Kojo\Data\JobInterface;

interface SelectorInterface
{
    const PROP_PROCESS_TYPE_CODE = 'process_type_code';
    const PROP_RANDOM_INT_MAX    = 'random_int_max';
    const PROP_OFFSET            = 'offset';
    const PROP_PAGE_SIZE         = 'page_size';
    const PROP_NEXT_JOB_TO_WORK  = 'next_job_to_work';

    public function getWorkableJob(): JobInterface;

    public function hasWorkableJob(): bool;

    public function setPageSize(int $pageSize): SelectorInterface;

    public function setOffset(int $offset): SelectorInterface;

    public function setRandomIntMax(int $randomIntMax): SelectorInterface;

    public function setProcess(ProcessInterface $process);
}