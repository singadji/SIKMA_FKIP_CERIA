<?php

namespace App\Exports;

use App\Models\SurveySession;
use Maatwebsite\Excel\Concerns\FromCollection;

class SurveyExport implements FromCollection
{
    public function collection()
    {
        return SurveySession::with('mahasiswa')
            ->get()
            ->map(function($item){

                return [

                    'Nama' => $item->mahasiswa->nama,

                    'NIM' => $item->mahasiswa->nim,

                    'Tanggal Survey' => $item->tanggal_survey,

                    'Status' => $item->status_selesai
                        ? 'Selesai'
                        : 'Belum',

                ];
            });
    }
}