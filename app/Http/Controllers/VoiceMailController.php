<?php

namespace App\Http\Controllers;

use App\Contracts\VoiceMail;
use Illuminate\Http\Request;


class VoiceMailController extends Controller
{
    private $voicemail;

    public function __construct(VoiceMail $voicemail)
    {
        $this->voicemail = $voicemail;
    }

    public function handle(Request $request)
    {
        $request->validate([
            'filename' => 'required|string',
        ]);

        return $this->voicemail->handle($request);
    }
}
