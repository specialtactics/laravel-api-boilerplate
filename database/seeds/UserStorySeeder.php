<?php

use App\Models\Role;
use App\Models\User;

class UserStorySeeder extends BaseSeeder
{
    public function runFake() {
        $roles = Role::all();

        factory(App\Models\User::class)->create([
            'name'         => 'Admin',
            'email'        => 'admin@admin.com',
            'primary_role' => $roles->where('name', 'admin')->first()->role_id,
        ]);

        for ($i = 0; $i < 5; ++$i) {
            factory(App\Models\User::class)->create([
                'primary_role' => $roles->random()->role_id,
            ]);

        }

    }
}
