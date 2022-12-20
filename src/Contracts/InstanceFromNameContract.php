<?php

namespace Dainsys\Mailing\Contracts;

interface InstanceFromNameContract
{
    public function __construct(string $namespace);

    public function get($class);
}
