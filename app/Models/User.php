<?php

namespace App\Models;

use App\Models\Role;
use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends BaseModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    JWTSubject
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;

    /**
     * @var int Auto increments integer key
     */
    public $primaryKey = 'user_id';

    /**
     * @var array Relations to load implicitly by Restful controllers
     */
    public static $localWith = ['primaryRole', 'roles'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'primary_role',
    ];

    /**
     * The attributes that should be hidden for arrays and API output
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verified_at', 'primary_role',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Model's boot function
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function (self $user) {
            // Hash user password, if not already hashed
            if (Hash::needsRehash($user->password)) {
                $user->password = Hash::make($user->password);
            }
        });
    }

    /**
     * Return the validation rules for this model
     *
     * @return array Rules
     */
    public function getValidationRules()
    {
        return [
            'email' => 'email|max:255|unique:users',
            'name'  => 'required|min:3',
            'password' => 'required|min:6',
        ];
    }

    /**
     * User's primary role
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function primaryRole()
    {
        return $this->belongsTo(Role::class, 'primary_role');
    }

    /**
     * User's secondary roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

    /**
     * Get all user's roles
     */
    public function getRoles()
    {
        $allRoles = array_merge(
            [
                $this->primaryRole->name,
            ],
            $this->roles->pluck('name')->toArray()
        );

        return $allRoles;
    }

    /**
     * Is this user an admin?
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->primaryRole->name == Role::ROLE_ADMIN;
    }

    /**
     * For Authentication
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * For Authentication
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'user' => [
                'id' => $this->getKey(),
                'name' => $this->name,
                'primaryRole' => $this->primaryRole->name,
            ],
        ];
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return $this->getKeyName();
    }
}
