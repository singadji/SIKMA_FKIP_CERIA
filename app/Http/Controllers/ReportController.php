<?php

namespace App\Http\Controllers;

use App\Models\SurveySession;
use App\Models\SurveyAnswer;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SurveyExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

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

        $survey = SurveySession::with("mahasiswa")->latest()->get();

        /*
        |--------------------------------------------------------------------------
        | IKM
        |--------------------------------------------------------------------------
        */

        $totalNilai = SurveyAnswer::sum("jawaban");

        $totalJawaban = SurveyAnswer::count();

        $ikm = 0;

        if ($totalJawaban > 0) {
            $ikm = round(($totalNilai / ($totalJawaban * 4)) * 100, 2);
        }

        /*
        |--------------------------------------------------------------------------
        | PDF
        |--------------------------------------------------------------------------
        */

        $pdf = Pdf::loadView("laporan.pdf", compact("survey", "ikm"));

        $pdf->setPaper("A4", "landscape");

        return $pdf->download("laporan-sikma.pdf");
    }

    /*
    |--------------------------------------------------------------------------
    | EXPORT EXCEL
    |--------------------------------------------------------------------------
    */

    public function exportExcel()
    {
        return Excel::download(new SurveyExport(), "laporan-sikma.xlsx");
    }

    public function laporanDosen()
    {
        $dosen = DB::table("survey_answers")
            ->join("dosen", "dosen.id", "=", "survey_answers.dosen_id")
            ->select(
                "dosen.nama_dosen",
                DB::raw("AVG(survey_answers.jawaban) as rata"),
                DB::raw("COUNT(survey_answers.id) as total"),
            )
            ->whereNotNull("survey_answers.dosen_id")
            ->groupBy("dosen.nama_dosen")
            ->orderByDesc("rata")
            ->get();

        return view("laporan.dosen", compact("dosen"));
    }

    public function laporanProdi()
    {
        $prodi = DB::table("survey_answers")
            ->join(
                "survey_sessions",
                "survey_sessions.id",
                "=",
                "survey_answers.session_id",
            )
            ->join(
                "mahasiswa",
                "mahasiswa.id",
                "=",
                "survey_sessions.mahasiswa_id",
            )
            ->join("prodi", "prodi.id", "=", "mahasiswa.prodi_id")
            ->select(
                "prodi.nama_prodi",
                DB::raw("AVG(survey_answers.jawaban) as rata"),
                DB::raw("COUNT(survey_answers.id) as total"),
            )
            ->groupBy("prodi.nama_prodi")
            ->orderByDesc("rata")
            ->get();

        return view("laporan.prodi", compact("prodi"));
    }

    public function laporanServqual()
    {
        $servqual = DB::table("survey_answers")
            ->join(
                "survey_questions",
                "survey_questions.id",
                "=",
                "survey_answers.question_id",
            )
            ->join(
                "survey_categories",
                "survey_categories.id",
                "=",
                "survey_questions.category_id",
            )
            ->select(
                "survey_categories.nama_kategori",
                "survey_categories.deskripsi",
                DB::raw("AVG(survey_answers.jawaban) as rata"),
            )
            ->groupBy(
                "survey_categories.nama_kategori",
                "survey_categories.deskripsi",
            )
            ->get();
        return view("laporan.servqual", compact("servqual"));
    }

    private function rekomendasi($nilai)
    {
        if ($nilai >= 3.5) {
            return "Sangat Baik";
        } elseif ($nilai >= 3) {
            return "Baik";
        } elseif ($nilai >= 2) {
            return "Perlu Peningkatan";
        }

        return "Prioritas Perbaikan";
    }
}
