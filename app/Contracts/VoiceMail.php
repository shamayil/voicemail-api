<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface VoiceMail
{

    public function handle(Request $request);
}
