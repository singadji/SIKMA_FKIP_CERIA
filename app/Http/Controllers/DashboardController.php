<?php

namespace App\Http\Controllers;

use App\Models\SurveySession;
use App\Models\SurveyAnswer;
use App\Models\Mahasiswa;
use App\Models\SurveyInstrument;
use Illuminate\Support\Facades\DB;
use App\Models\SurveyCategory;
use App\Models\Prodi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalResponden = SurveySession::distinct("mahasiswa_id")->count(
            "mahasiswa_id",
        );
        $totalMahasiswa = Mahasiswa::count();
        $totalInstrumen = SurveyInstrument::count();
        $totalNilai = SurveyAnswer::sum("jawaban");
        $totalJawaban = SurveyAnswer::count();
        $totalProdi = Prodi::count();
        $ikm = 0;

        if ($totalJawaban > 0) {
            $ikm = round(($totalNilai / ($totalJawaban * 4)) * 100, 2);
        }

        $instrumenChart = SurveyInstrument::leftJoin(
            "survey_answers",
            "survey_instruments.id",
            "=",
            "survey_answers.instrument_id",
        )
            ->select(
                "survey_instruments.nama_instrumen",
                DB::raw("COUNT(survey_answers.id) as total"),
            )
            ->groupBy(
                "survey_instruments.id",
                "survey_instruments.nama_instrumen",
            )
            ->orderBy("survey_instruments.id")
            ->get();

        $pieLabels = $instrumenChart->pluck("nama_instrumen");
        $pieSeries = $instrumenChart->pluck("total");

        $kepuasanPerProdi = DB::table("survey_answers")
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
                DB::raw("AVG(survey_answers.jawaban) as rata_rata"),
            )
            ->groupBy("prodi.nama_prodi")
            ->orderByDesc("rata_rata")
            ->get();
        /*
        |--------------------------------------------------------------------------
        | CHART MATA KULIAH
        |--------------------------------------------------------------------------
        */

        /*
        |--------------------------------------------------------------------------
        | TABLE REALTIME
        |--------------------------------------------------------------------------
        */

        $latestSurvey = SurveySession::with("mahasiswa")
            ->latest()
            ->take(10)
            ->get();

        $surveySessions = SurveySession::all();

        return view(
            "dashboard.index",
            compact(
                "totalResponden",
                "totalMahasiswa",
                "ikm",
                "pieLabels",
                "pieSeries",
                "latestSurvey",
                "totalProdi",
                "kepuasanPerProdi",
                "surveySessions",
            ),
        );
    }
}
