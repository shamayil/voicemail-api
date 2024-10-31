<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tbluser';

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The primary key for the model.
     *
     * @var string
     */

    protected $primaryKey = 'rno';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */

    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
