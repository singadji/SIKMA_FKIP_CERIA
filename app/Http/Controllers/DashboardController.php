<?php

namespace App\Http\Controllers;

use App\Models\SurveySession;
use App\Models\SurveyAnswer;
use App\Models\Mahasiswa;
use App\Models\SurveyInstrument;
use Illuminate\Support\Facades\DB;
use App\Models\SurveyCategory;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        $totalResponden = SurveySession::count();

        $totalMahasiswa = Mahasiswa::count();

        $totalInstrumen = SurveyInstrument::count();

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
        | RADAR SERVQUAL
        |--------------------------------------------------------------------------
        */

        $radar = SurveyCategory::select(
            "survey_categories.nama_kategori",
            DB::raw("AVG(survey_answers.jawaban) as rata"),
        )
            ->join(
                "survey_questions",
                "survey_questions.category_id",
                "=",
                "survey_categories.id",
            )
            ->join(
                "survey_answers",
                "survey_answers.question_id",
                "=",
                "survey_questions.id",
            )
            ->groupBy("survey_categories.nama_kategori")
            ->get();

        /*
        |--------------------------------------------------------------------------
        | PIE CHART INSTRUMEN
        |--------------------------------------------------------------------------
        */

        $instrumenChart = SurveyInstrument::select(
            "survey_instruments.nama_instrumen",
            DB::raw("COUNT(survey_answers.id) as total"),
        )
            ->leftJoin(
                "survey_answers",
                "survey_answers.instrument_id",
                "=",
                "survey_instruments.id",
            )
            ->groupBy("survey_instruments.nama_instrumen")
            ->get();

        /*
        |--------------------------------------------------------------------------
        | CHART PRODI
        |--------------------------------------------------------------------------
        */

        $chartProdi = DB::table("survey_answers")
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
            )
            ->groupBy("prodi.nama_prodi")
            ->get();

        /*
        |--------------------------------------------------------------------------
        | CHART DOSEN
        |--------------------------------------------------------------------------
        */

        $chartDosen = DB::table("survey_answers")
            ->join("dosen", "dosen.id", "=", "survey_answers.dosen_id")
            ->select(
                "dosen.nama_dosen",
                DB::raw("AVG(survey_answers.jawaban) as rata"),
            )
            ->whereNotNull("survey_answers.dosen_id")
            ->groupBy("dosen.nama_dosen")
            ->limit(10)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | TABLE REALTIME
        |--------------------------------------------------------------------------
        */

        $latestSurvey = SurveySession::with("mahasiswa")
            ->latest()
            ->take(10)
            ->get();

        return view(
            "dashboard.index",
            compact(
                "totalResponden",
                "totalMahasiswa",
                "totalInstrumen",
                "ikm",
                "radar",
                "instrumenChart",
                "chartProdi",
                "chartDosen",
                "latestSurvey",
            ),
        );
    }
}
