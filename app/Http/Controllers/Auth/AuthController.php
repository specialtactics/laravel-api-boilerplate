<?php

namespace App\Http\Controllers\Auth;

use App\Services\RestfulService;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthController extends BaseController
{

    public static $model = User::class;

    /**
     * Create a new AuthController instance.
     *
     */
    public function __construct(RestfulService $restfulService)
    {
        parent::__construct($restfulService);

        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            throw new UnauthorizedHttpException('Unauthorized login');
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     */
    public function getUser()
    {
        // @todo: Might be better to redirect to user controller
        return $this->response->item(auth()->user(), new static::$transformer);
    }

    /**
     * Log the user out (Invalidate the token).
     */
    public function logout()
    {
        auth()->logout();

        return $this->response->noContent();
    }

    /**
     * Refresh a token.
     *
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     */
    protected function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60, // 60 = seconds in a minute
        ]);
    }
}
