<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param string $ability
     * @return bool|null
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Student $student
     * @return mixed
     */
    public function view(User $user, Student $student)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isMethodist();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Student $student
     * @return mixed
     */
    public function update(User $user, Student $student)
    {
        return $user->isMethodist();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Student $student
     * @return mixed
     */
    public function delete(User $user, Student $student)
    {
        return $user->isMethodist();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Student $student
     * @return mixed
     */
    public function restore(User $user, Student $student)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Student $student
     * @return mixed
     */
    public function forceDelete(User $user, Student $student)
    {
        return false;
    }
}
