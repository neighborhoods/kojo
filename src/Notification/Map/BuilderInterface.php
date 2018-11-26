<?php

namespace Neighborhoods\Kojo\Notification\Map;

interface BuilderInterface
{

    public function build() : \Neighborhoods\Kojo\Notification\MapInterface;
    public function setRecords(array $record) : \Neighborhoods\Kojo\Notification\Map\BuilderInterface;

}

