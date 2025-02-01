<?php

namespace App\Models;

class Role extends BaseModel
{
    /**
     * Role constants
     */
    public const ROLE_ADMIN = 'admin';

    /**
     * @var int Auto increments integer key
     */
    public $primaryKey = 'role_id';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];
}
