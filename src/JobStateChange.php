<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

class JobStateChange implements JobStateChangeInterface
{
    /** @var int */
    protected $id;
    /** @var JobStateChange\DataInterface */
    protected $data;

    public function getId() : int
    {
        if ($this->id === null) {
            throw new \LogicException('JobStateChange id has not been set.');
        }
        return $this->id;
    }

    public function setId(int $id) : JobStateChangeInterface
    {
        if ($this->id !== null) {
            throw new \LogicException('JobStateChange id is already set.');
        }
        $this->id = $id;
        return $this;
    }

    public function getData() : JobStateChange\DataInterface
    {
        if ($this->data === null) {
            throw new \LogicException('JobStateChange data has not been set.');
        }
        return $this->data;
    }

    public function setData(JobStateChange\DataInterface $data) : JobStateChangeInterface
    {
        if ($this->data !== null) {
            throw new \LogicException('JobStateChange data is already set.');
        }
        $this->data = $data;
        return $this;
    }
}
