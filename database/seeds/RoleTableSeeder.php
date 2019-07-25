<?php

use App\Models\Role;

class RoleTableSeeder extends BaseSeeder
{
    public function runAlways()
    {
        Role::firstOrCreate([
            'name' => 'admin',
            'description' => 'Administrator Users',
        ]);

        Role::firstOrCreate([
            'name' => 'regular',
            'description' => 'Regular Users',
        ]);
    }

    public function runFake()
    {
        for ($i = 0; $i < 10; ++$i) {
            Role::firstOrCreate([
                'name' => $this->faker->unique()->word(),
                'description' => $this->faker->sentence(),
            ]);
        }
    }

    /**
     * Get a collection of random roles
     * Remove duplicates to prevent SQL errors, also prevent infinite loop in case of not enough roles
     *
     * @param $count int How many roles to get
     * @return Illuminate\Support\Collection
     */
    public static function getRandomRoles($count)
    {
        $roles = Role::all();

        $fakeRoles = [];
        $i = 0;

        do {
            ++$i;
            $fakeRoles[] = $roles->whereNotIn('name', ['admin'])->random();
            $fakeRoles = array_unique($fakeRoles);
        } while (count($fakeRoles) < $count && $i < 50); // Iteration limit

        return collect($fakeRoles);
    }
}
