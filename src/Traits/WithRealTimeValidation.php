<?php

namespace Dainsys\Report\Traits;

trait WithRealTimeValidation
{
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
