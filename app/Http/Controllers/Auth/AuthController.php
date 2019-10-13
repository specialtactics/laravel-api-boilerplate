<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Specialtactics\L5Api\Http\Controllers\Features\JWTAuthenticationTrait;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthController extends Controller
{
    use JWTAuthenticationTrait;
}
