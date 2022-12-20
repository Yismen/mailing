<?php

namespace Dainsys\Mailing\Policies;

use Dainsys\Mailing\Models\Mailable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Dainsys\Mailing\Policies\Traits\HasAdminCheck;

class MailablePolicy
{
    use HasAdminCheck;
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User                      $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User                      $user
     * @param  \App\Models\Mailable                  $site
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Mailable $site)
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User                      $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User                      $user
     * @param  \App\Models\Mailable                  $site
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Mailable $site)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User                      $user
     * @param  \App\Models\Mailable                  $site
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Mailable $site)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User                      $user
     * @param  \App\Models\Mailable                  $site
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Mailable $site)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User                      $user
     * @param  \App\Models\Mailable                  $site
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Mailable $site)
    {
        return false;
    }
}
