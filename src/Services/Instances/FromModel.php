<?php

namespace Dainsys\Report\Services\Instances;

use InvalidArgumentException;
use Dainsys\Report\Contracts\InstanceFromNameContract;

class FromModel implements InstanceFromNameContract
{
    protected $namespace;

    public function __construct(string $namespace)
    {
        $this->namespace = $namespace;
    }

    public function get($class)
    {
        $string = str($class)->contains($this->namespace) ?
            $class :
            join('\\', [
                $this->namespace,
                $class
            ]);
        try {
            return new $string();
        } catch (\Throwable $th) {
            throw new InvalidArgumentException("Class {$string} Not Found");
        }
    }
}
