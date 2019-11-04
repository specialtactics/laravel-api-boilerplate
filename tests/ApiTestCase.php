<?php

namespace Tests;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use JWTAuth;
use UserStorySeeder;

abstract class ApiTestCase extends TestCase
{
    /**
     * Set the currently logged in user for the application and Authorization headers for API request
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable
     * @param  string|null  $driver
     * @return $this
     */
    public function actingAs(UserContract $user, $driver = null)
    {
        parent::actingAs($user, $driver);

        return $this->withHeader('Authorization', 'Bearer ' . JWTAuth::fromUser($user));
    }

    /**
     * API Test case helper function for setting up
     * the request auth header as supplied user
     *
     * @param array $credentials
     * @return $this
     */
    public function actingAsUser($credentials)
    {
        if (!$token = JWTAuth::attempt($credentials)) {
            return $this;
        }

        $user = ($apiKey = Arr::get($credentials, 'api_key'))
            ? User::whereApiKey($apiKey)->firstOrFail()
            : User::whereEmail(Arr::get($credentials, 'email'))->firstOrFail();

        return $this->actingAs($user);
    }

    /**
     * API Test case helper function for setting up the request as a logged in admin user
     *
     * @return $this
     */
    public function actingAsAdmin()
    {
        $user = User::where('email', UserStorySeeder::ADMIN_CREDENTIALS['email'])->firstOrFail();

        return $this->actingAs($user);
    }
}
