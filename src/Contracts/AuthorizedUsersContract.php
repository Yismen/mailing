<?php

namespace Dainsys\Mailing\Contracts;

interface AuthorizedUsersContract
{
    public function has(string $email): bool;
}
