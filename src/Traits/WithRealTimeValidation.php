<?php

namespace Dainsys\Mailing\Traits;

trait WithRealTimeValidation
{
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
