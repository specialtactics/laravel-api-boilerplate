<?php

namespace App\Models\Policies;

use App\Models\User;
use Specialtactics\L5Api\Policies\RestfulModelPolicy;

class BasePolicy extends RestfulModelPolicy
{
    /**
     * Process 'global' authorisation rules
     *
     * @param $user
     * @param $ability
     * @return bool
     */
    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
}
