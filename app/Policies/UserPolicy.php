<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasRole('operator_ppid');
    }

    public function create(User $user)
    {
        return $user->hasRole('operator_ppid');
    }

    public function update(User $user, User $model)
    {
        return $user->hasRole('operator_ppid');
    }

    public function delete(User $user, User $model)
    {
        return !$model->is_super_admin && $user->hasRole('operator_ppid');
    }
}
