<?php

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Production Only
        if (App::environment() == 'production') {
            $this->runProduction();
        }
        // Fake environments
        else {
            $this->runFake();
        }

        // Any environment
        $this->runAlways();
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
