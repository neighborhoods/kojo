<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

interface StateTransitionChangeInterface
{
    public const PROP_ID = 'id';
    public const PROP_DATA = 'data';

    public function getId() : int;
    public function setId(int $id) : StateTransitionChangeInterface;

    public function getData() : StateTransitionChange\DataInterface;
    public function setData(StateTransitionChange\DataInterface $data) : StateTransitionChangeInterface;
}
