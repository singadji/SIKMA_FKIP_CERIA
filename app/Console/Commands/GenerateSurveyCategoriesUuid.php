<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SurveyCategory;
use Illuminate\Support\Str;

class GenerateSurveyCategoriesUuid extends Command
{
    protected $signature = "survey-categories:generate-uuid";

    protected $description = "Generate UUID survey categories";

    public function handle()
    {
        SurveyCategory::whereNull("uuid")->chunk(100, function ($items) {
            foreach ($items as $item) {
                $item->uuid = Str::uuid();

                $item->save();
            }
        });

        $this->info("Selesai.");

        return Command::SUCCESS;
    }
}
