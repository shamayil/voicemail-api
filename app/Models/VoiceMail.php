<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class VoiceMail extends Model
{
    protected $table = 'tblmaillog';

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

    public function getUrlAttribute()
    {
        try {
            return Storage::disk('s3')->temporaryUrl("$this->filename", Carbon::now()->addDays(2));
        } catch (Exception $e) {
            return null;
        }
    }
}
