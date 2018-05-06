<?php

namespace Tests;

abstract class ApiTestCase extends TestCase
{
    /**
     * Do a refresh and seed of the database on demand, whenever we want
     *
     * @return void
     */
    public function refreshAndSeedDatabase()
    {
        $this->artisan('migrate:fresh');
        $this->seed(\DatabaseSeeder::class);
    }
}
