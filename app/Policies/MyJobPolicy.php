<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\MyJob;
use App\Models\User;

class MyJobPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function viewAnyEmployer(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, MyJob $myJob): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->employer() !== null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MyJob $myJob): bool|Response
    {
        if($myJob->employer->user_id !== $user->id){
            return false;
        }

        if($myJob->jobApplications()->count() > 0){
            return Response::deny('Cannot change the Job with Applications');
        }

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MyJob $myJob): bool
    {
        return $myJob->employer->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MyJob $myJob): bool
    {
        return $myJob->employer->user_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MyJob $myJob): bool
    {
        return $myJob->employer->user_id === $user->id;
    }

    public function apply(User $user, MyJob $myJob): bool{
        return !$myJob->hasUserApplied($user);
    }
}
