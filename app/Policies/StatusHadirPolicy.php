<?php

namespace App\Policies;

use App\StatusHadir;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusHadirPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\StatusHadir  $statusHadir
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, StatusHadir $statusHadir)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\StatusHadir  $statusHadir
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, StatusHadir $statusHadir)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\StatusHadir  $statusHadir
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, StatusHadir $statusHadir)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\StatusHadir  $statusHadir
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, StatusHadir $statusHadir)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\StatusHadir  $statusHadir
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, StatusHadir $statusHadir)
    {
        //
    }
}
