<?php

namespace Dainsys\Mailing\Policies\Traits;

use Illuminate\Foundation\Auth\User;

trait HasAdminCheck
{
    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User $user
     * @param  string           $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        return $user->can('interact-with-mailing-admin');
    }
}
