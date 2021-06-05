<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
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
        $this->faker = \Faker\Factory::create();

        $this->before();

        // Run in any environment
        $this->runAlways();

        // Production Only
        if (app()->environment() === 'production') {
            $this->runProduction();
        }
        // Fake environments
        else {
            $this->runFake();
        }

        $this->after();
    }

    /**
     * Run fake seeds - for non production environments
     *
     * @return void
     */
    public function runFake()
    {
    }

    /**
     * Run seeds to be ran only on production environments
     *
     * @return void
     */
    public function runProduction()
    {
    }

    /**
     * Run seeds to be ran on every environment (including production)
     *
     * @return void
     */
    public function runAlways()
    {
    }

    /**
     * Run before all any seeding
     *
     * @return void
     */
    public function before()
    {
    }

    /**
     * Run after all seeding
     *
     * @return void
     */
    public function after()
    {
    }
}
