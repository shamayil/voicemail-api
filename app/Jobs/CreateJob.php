<?php

namespace App\Jobs;
use App\Action\GetVoiceMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;


class CreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {

        $totalCount = collect(Storage::disk('voicemail')->files('received-email'))->count();

        if ($totalCount == 0 || $totalCount == null) {
            return;
        }

        $items = collect(Storage::disk('voicemail')->files('received-email'))
            ->take(4);

        foreach ($items as $task)
        {
            (new GetVoiceMail())->handle($task);
        }

    }
}
