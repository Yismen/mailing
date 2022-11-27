<?php

namespace Dainsys\Report\Contracts;

interface InstanceFromNameContract
{
    public function __construct(string $namespace);

    public function get($class);
}
