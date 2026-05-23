<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SurveySession;
use Illuminate\Support\Str;

class GenerateSurveySessionUuid extends Command
{
    protected $signature = "survey-session:generate-uuid";

    protected $description = "Generate UUID survey session";

    public function handle()
    {
        SurveySession::whereNull("uuid")
        ->chunk(100, function ($items) {
            foreach ($items as $item) {
                $item->uuid = Str::uuid();

                $item->save();
            }
        });

        $this->info("Selesai.");

        return Command::SUCCESS;
    }
}
