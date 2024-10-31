<?php

namespace App\Action;

use App\Models\CustomerTel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportFile
{
    public function handle(Object $message, String $fileName, String $file, String $telNumber, String $datetime)
    {
        foreach ($message->getAllAttachmentParts() as $attachment)
        {
            $attachmentName = $attachment->getFileName();
            $extension = explode('.',$attachmentName);

            if (str_contains($attachmentName, "voicemail"))
            {
                $custDetails = [];
                $fileName = 'voicemail' . '-' . Str::random(32) . '.' . $extension[1];
                $filePath = Carbon::now()->isoFormat('Y/M/D');
                $RefPath = "$filePath/$fileName";
                Storage::disk('s3')->put("$RefPath",  $attachment->getContent());
                $customerTelNumbers = CustomerTel::where('telno', $telNumber)->get();

                if ($customerTelNumbers->isNotEmpty())
                {
                    foreach ($customerTelNumbers as $customer)
                    {
                        $custDetails[] = [
                            'custno' => $customer->custrno,
                            'shopname' => $customer->name
                        ];
                    }
                }
            }

             Storage::disk('voicemail')->delete($file);
            (new StoreVoiceMail())->handle($telNumber, $RefPath, $datetime, $custDetails);
        }
    }
}
