<?php
declare(strict_types=1);

namespace Neighborhoods\Kojo;

interface JobStateChangeInterface extends \JsonSerializable
{
    public const PROP_ID = 'id';
    public const PROP_DATA = 'data';

    public function getId() : int;
    public function setId(int $id) : JobStateChangeInterface;

    public function getData() : JobStateChange\DataInterface;
    public function setData(JobStateChange\DataInterface $data) : JobStateChangeInterface;
}
