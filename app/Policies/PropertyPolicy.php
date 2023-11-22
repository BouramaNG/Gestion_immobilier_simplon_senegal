<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PropertyPolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        
    }

   

    public function view(User $user)
    {
        // Vérifie si le compte de l'utilisateur est actif
        return $user->status === 'inactive';
    }

    public function search(User $user)
    {
        // Vérifie si le compte de l'utilisateur est actif
        return $user->status === 'inactive';
    }
}
