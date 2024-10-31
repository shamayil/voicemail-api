<?php

namespace App\Repositories;

use App\Constants\Messages;
use App\Contracts\VoiceMail as VoiceMailContract;
use App\Exceptions\UnprocessableEntityException;
use App\Models\VoiceMail;
use Illuminate\Http\Request;

class VoiceMailRepository implements VoiceMailContract
{

    public function handle(Request $request)
    {
        $filename = $request->filename;
        $Attachments = VoiceMail::where('filename', $filename)->first();
        
        if($Attachments == null)
        {
            throw new UnprocessableEntityException(
                Messages::VOICEMAIL_ATTACHMENTS_NOT_FOUND,
                'Not Found'
            );
        }

        return [
            'data' => [
                'telno' => $Attachments->telno,
                'readstate' => $Attachments->readstate,
                'filename' => $Attachments->filename,
                'url' => $Attachments['url']
            ],
            'status'=> "OK",
            'message' => Messages::VOICEMAIL_ATTACHMENTS_FOUND,
            'errors' => null
        ];
    }

}
