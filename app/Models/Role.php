<?php

namespace App\Models;

class Role extends BaseModel {
    /**
     * @var int Auto increments integer key
     */
    public $primaryKey = 'role_id';

    /**
     * @var string UUID key
     */
    public $uuidKey = 'role_uuid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'role_id',
    ];
}
