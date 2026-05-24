<?php

namespace App\Console\Commands;

use App\Models\Mahasiswa;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateMahasiswaUuid extends Command
{
    protected $signature = "mahasiswa:generate-uuid";

    protected $description = "Generate UUID untuk mahasiswa lama";

    public function handle()
    {
        $this->info("Generate UUID mahasiswa...");

        Mahasiswa::whereNull("uuid")
        ->chunkById(100, function ($items) {
            foreach ($items as $item) {
                $item->uuid = Str::uuid();

                $item->save();
            }
        });

        $this->info("Selesai generate UUID.");

        return Command::SUCCESS;
    }
}
