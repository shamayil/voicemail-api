<?php

namespace App\Action;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ZBateson\MailMimeParser\Message;

class GetVoiceMail
{
    public function handle(string $task)
    {
        $data = Storage::disk('voicemail')->get($task);
        $fileName = Arr::get(explode('received-email/', $task), 1);
        $message = Message::from($data, false);
        $now = $message->getHeaderValue('Date');
        $datetime = Carbon::parse($now)->toDateTimeString();
        $subject = $message->getHeaderValue('Subject');
        Log::info("---- Access Files ---- ");

        if (str_contains($subject, "Voicemail"))
        {
            Log::info("---- Access Voicemail ---- ");
            $subjectExplode = explode(' ',$subject);
            $SubjectTelno = end($subjectExplode);
            $TelNo ="0".ltrim($SubjectTelno, "+44");
            $subjectFinal = explode('*Support',$TelNo);
            $telNumber = $subjectFinal[0];

            if ($message->getAttachmentCount())
            {
                (new ImportFile())->handle($message, $fileName, $task, $telNumber, $datetime);
            }
        }
    }
}
