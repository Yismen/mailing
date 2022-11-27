<?php

namespace Dainsys\Report\Contracts;

interface AuthorizedUsersContract
{
    public function has(string $email): bool;
}
