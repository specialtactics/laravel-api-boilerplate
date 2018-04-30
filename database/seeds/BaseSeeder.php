<?php

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder {
    /**
     * @var null Faker instance
     */
    public $faker = null;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // You can set the locale of your seeder as a parameter to the create function
        // Available locales: https://github.com/fzaninotto/Faker/tree/master/src/Faker/Provider
        $this->faker = Faker\Factory::create();

        // Run in any environment
        $this->runAlways();

        // Production Only
        if (App::environment() == 'production') {
            $this->runProduction();
        }
        // Fake environments
        else {
            $this->runFake();
        }
    }

    /**
     * Run fake seeds - for non production environments
     *
     * @return mixed
     */
    public function runFake() {}

    /**
     * Run seeds to be ran only on production environments
     *
     * @return mixed
     */
    public function runProduction() {}

    /**
     * Run seeds to be ran on every environment (including production)
     *
     * @return mixed
     */
    public function runAlways() {}
}
