<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends RestfulController
{
    public static $model = User::class;

}
