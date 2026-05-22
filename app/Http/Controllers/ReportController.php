<?php

namespace App\Http\Controllers;

use App\Models\SurveySession;
use App\Models\SurveyAnswer;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SurveyExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | EXPORT PDF
    |--------------------------------------------------------------------------
    */

    public function exportPdf()
    {
        /*
        |--------------------------------------------------------------------------
        | DATA
        |--------------------------------------------------------------------------
        */

        $survey = SurveySession::with('mahasiswa')
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | IKM
        |--------------------------------------------------------------------------
        */

        $totalNilai = SurveyAnswer::sum('jawaban');

        $totalJawaban = SurveyAnswer::count();

        $ikm = 0;

        if ($totalJawaban > 0) {

            $ikm = round(
                ($totalNilai / ($totalJawaban * 4)) * 100,
                2
            );
        }

        /*
        |--------------------------------------------------------------------------
        | PDF
        |--------------------------------------------------------------------------
        */

        $pdf = Pdf::loadView(
            'laporan.pdf',
            compact(
                'survey',
                'ikm'
            )
        );

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download(
            'laporan-sikma.pdf'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EXPORT EXCEL
    |--------------------------------------------------------------------------
    */

    public function exportExcel()
    {
        return Excel::download(
            new SurveyExport,
            'laporan-sikma.xlsx'
        );
    }
}