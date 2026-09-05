<?php

namespace App\Policies;

use App\Models\BusinessCard;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BusinessCardPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function before($user, $ability)
    {
        if ($user->role === 'admin') {
            return true;
        }
    }

    public function view(User $user, BusinessCard $businessCard): bool
    {
        return $user->id === $businessCard->user_id;
    }

    public function update(User $user, BusinessCard $businessCard): bool
    {
        return $user->id === $businessCard->user_id;
    }

    public function delete(User $user, BusinessCard $businessCard): bool
    {
        return $user->id === $businessCard->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BusinessCard $businessCard): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BusinessCard $businessCard): bool
    {
        //
    }
}
