<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerTel extends Model
{
    protected $table = 'tblcustomertel';

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
