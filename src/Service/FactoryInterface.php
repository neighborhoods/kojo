<?php

namespace NHDS\Jobs\Service;

interface FactoryInterface
{
    public function setName(string $factoryName);

    public function getName(): string;

    public function create();
}