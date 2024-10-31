<?php

namespace App\Console\Commands;
use App\Jobs\CreateJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ImportVoiceMailCommand extends Command
{
    protected $signature = 'import:voicemails';

    protected $description = 'import Voicemails';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Log::info("---- CreateJob Dispatched ---- ");
        dispatch(new CreateJob());
    }
}
