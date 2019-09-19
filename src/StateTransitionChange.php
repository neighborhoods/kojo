<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

class StateTransitionChange implements StateTransitionChangeInterface
{
    /** @var int */
    protected $id;
    /** @var StateTransitionChange\DataInterface */
    protected $data;

    public function getId() : int
    {
        if ($this->id === null) {
            throw new \LogicException('StateTransitionChange id has not been set.');
        }
        return $this->id;
    }

    public function setId(int $id) : StateTransitionChangeInterface
    {
        if ($this->id !== null) {
            throw new \LogicException('StateTransitionChange id is already set.');
        }
        $this->id = $id;
        return $this;
    }

    public function getData() : StateTransitionChange\DataInterface
    {
        if ($this->data === null) {
            throw new \LogicException('StateTransitionChange data has not been set.');
        }
        return $this->data;
    }

    public function setData(StateTransitionChange\DataInterface $data) : StateTransitionChangeInterface
    {
        if ($this->data !== null) {
            throw new \LogicException('StateTransitionChange data is already set.');
        }
        $this->data = $data;
        return $this;
    }
}
