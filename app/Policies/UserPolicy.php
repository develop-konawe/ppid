<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAny(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function view(User $user, User $model)
    {
        return $user->isSuperAdmin();
    }

    public function create(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function update(User $user, User $model)
    {
        return $user->isSuperAdmin();
    }

    public function delete(User $user, User $model)
    {
        // Cegah Super Admin menghapus akunnya sendiri
        return $user->isSuperAdmin() && $user->id !== $model->id;
    }
}
