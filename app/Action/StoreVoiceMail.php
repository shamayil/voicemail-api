<?php

namespace App\Action;

use App\Models\CustVoiceMail;
use App\Models\VoiceMail;
use Carbon\Carbon;

class StoreVoiceMail
{
    public function handle(String $newTelno, String $emailRefPath, String $date, Array $custDetails)
    {
        $newMail = VoiceMail::create([
            'telno' => $newTelno,
            'voicefile' => $emailRefPath,
            'filename' => $emailRefPath,
            'maildate' => Carbon::parse($date)->toDateTimeString(),
            'regdate' => Carbon::now(),
            'cusrno' => null,
            'name' => null,
            'issuerno' => 0,
            'readstate' => 0,
            'comment' => 'CANT FIND',
            'maildate2' => null,
        ]);

        $voiceMailId = $newMail["rno"];

        foreach ($custDetails as $custContact) {
            CustVoiceMail::create([
                'maillog_id' => $voiceMailId,
                'cusrno' => $custContact['custno'],
                'name' => $custContact['shopname'],
            ]);
        }
    }
}
