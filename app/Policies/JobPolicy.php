<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Job $job): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'employer';
    }

    /**
     * Determine if the user can view applied jobs.
     */
    public function viewAppliedJobs(User $user, Job $job): bool
    {
        return $user->role === 'member' && $job->applications()->where('user_id', $user->id)->exists();
    }

    /**
     * Determine if the user can apply for a job.
     */
    public function apply(User $user, Job $job): bool
    {
        return $user->role === 'member';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Job $job): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Job $job): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Job $job): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Job $job): bool
    {
        return false;
    }
}
