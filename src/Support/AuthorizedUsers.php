<?php

namespace Dainsys\Mailing\Support;

use Dainsys\Mailing\Contracts\AuthorizedUsersContract;

class AuthorizedUsers implements AuthorizedUsersContract
{
    protected array $authorizedEmails;

    public function __construct()
    {
        $this->authorizedEmails = array_map(
            function ($element) {
                return trim($element);
            },
            preg_split(
                "/[\|,]+/",
                config('mailing.super_users'),
                -1,
                PREG_SPLIT_NO_EMPTY
            )
        );
    }

    public function has(string $email): bool
    {
        return in_array($email, $this->authorizedEmails);
    }
}
