<?php

use App\Models\Role;

class RoleTableSeeder extends BaseSeeder
{
    public function runAlways() {
        Role::firstOrCreate([
            'name' => 'admin',
            'description' => 'Administrator Users',
        ]);
    }

    public function runFake() {
        for ($i = 0; $i < 10; ++$i) {
            Role::firstOrCreate([
                'name' => $this->faker->unique()->word(),
                'description' => $this->faker->sentence(),
            ]);
        }
    }
}
