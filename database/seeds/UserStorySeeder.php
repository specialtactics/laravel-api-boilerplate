<?php

class UsersTableSeeder extends BaseSeeder
{
    public function runFake() {
        factory(App\Models\User::class)->create([
            'first_name'        => 'Admin',
            'surname'           => 'User',
            'email'             => 'admin@admin.com',
            'preferred_locale' => null,
            'role_id'        => $roles->where('name', 'admin')->first()->id,
        ]);
    }
}
