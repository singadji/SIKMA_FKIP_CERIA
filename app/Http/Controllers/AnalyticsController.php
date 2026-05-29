<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function perProdi()
    {
        $raw = DB::table("survey_answers")
            ->join(
                "survey_questions",
                "survey_answers.question_id",
                "=",
                "survey_questions.id",
            )
            ->join(
                "survey_categories",
                "survey_questions.category_id",
                "=",
                "survey_categories.id",
            )
            ->join(
                "survey_sessions",
                "survey_answers.session_id",
                "=",
                "survey_sessions.id",
            )
            ->join(
                "mahasiswa",
                "survey_sessions.mahasiswa_id",
                "=",
                "mahasiswa.id",
            )
            ->join("prodi", "mahasiswa.prodi_id", "=", "prodi.id")
            ->select(
                "prodi.id as prodi_id",
                "prodi.nama_prodi",
                "survey_categories.id as category_id",
                "survey_categories.nama_kategori",
                DB::raw("ROUND(AVG(survey_answers.jawaban), 2) as rata_rata"),
            )
            ->where("survey_answers.instrument_id", 1)
            ->groupBy(
                "prodi.id",
                "prodi.nama_prodi",
                "survey_categories.id",
                "survey_categories.nama_kategori",
            )
            ->orderBy("prodi.nama_prodi")
            ->orderBy("survey_categories.id")
            ->get();
        $categories = $raw->pluck("nama_kategori")->unique()->values();

        $pivot = [];
        foreach ($raw as $row) {
            if (!isset($pivot[$row->nama_prodi])) {
                $pivot[$row->nama_prodi] = [];
            }
            $pivot[$row->nama_prodi][$row->nama_kategori] = $row->rata_rata;
        }

        foreach ($pivot as $prodi => $nilai) {
            $total = 0;
            $jumlah = 0;
            foreach ($categories as $category) {
                $value = $nilai[$category] ?? 0;
                if ($value > 0) {
                    $total += $value;
                    $jumlah++;
                }
            }
            $pivot[$prodi]["RERATA_TOTAL"] =
                $jumlah > 0 ? round($total / $jumlah, 2) : 0;
        }

        $page = "Analytics";
        $judul = "Analytics Survey";
        $subjudul = "Rerata Per Indikator Survey Per Prodi";

        return view(
            "analytics.per-prodi",
            compact("pivot", "categories", "page", "judul", "subjudul"),
        );
    }

    public function fakultas()
    {
        $indikator = DB::table("survey_answers")
            ->join(
                "survey_questions",
                "survey_answers.question_id",
                "=",
                "survey_questions.id",
            )
            ->join(
                "survey_categories",
                "survey_questions.category_id",
                "=",
                "survey_categories.id",
            )
            ->select(
                "survey_categories.nama_kategori",
                DB::raw("ROUND(AVG(survey_answers.jawaban), 2) as rata_rata"),
            )
            ->where("survey_answers.instrument_id", 1)
            ->groupBy("survey_categories.nama_kategori")
            ->orderBy("survey_categories.id")
            ->get();

        $ikm = DB::table("survey_answers")
            ->where("instrument_id", 1)
            ->avg("jawaban");
        $ikm = round($ikm, 2);

        $page = "Analytics";
        $judul = "Analytics Fakultas";
        $subjudul = "Rerata Survey Seluruh Program Studi";

        return view(
            "admin.analytics.fakultas",
            compact("indikator", "ikm", "page", "judul", "subjudul"),
        );
    }

    public function perInstrumen()
    {
        $raw = DB::table("survey_answers")
            ->join(
                "survey_questions",
                "survey_answers.question_id",
                "=",
                "survey_questions.id",
            )
            ->join(
                "survey_categories",
                "survey_questions.category_id",
                "=",
                "survey_categories.id",
            )
            ->join(
                "survey_instruments",
                "survey_answers.instrument_id",
                "=",
                "survey_instruments.id",
            )
            ->join(
                "survey_sessions",
                "survey_answers.session_id",
                "=",
                "survey_sessions.id",
            )
            ->join(
                "mahasiswa",
                "survey_sessions.mahasiswa_id",
                "=",
                "mahasiswa.id",
            )
            ->join("prodi", "mahasiswa.prodi_id", "=", "prodi.id")
            ->select(
                "survey_instruments.id as instrument_id",
                "survey_instruments.nama_instrumen",
                "prodi.nama_prodi",
                "survey_categories.nama_kategori",
                DB::raw("ROUND(AVG(survey_answers.jawaban),2) as rata_rata"),
            )
            ->groupBy(
                "survey_instruments.id",
                "survey_instruments.nama_instrumen",
                "prodi.nama_prodi",
                "survey_categories.nama_kategori",
            )
            ->orderBy("survey_instruments.id")
            ->orderBy("prodi.nama_prodi")
            ->get();

        $analytics = [];
        foreach ($raw as $row) {
            $instrument = $row->nama_instrumen;
            $prodi = $row->nama_prodi;
            $kategori = $row->nama_kategori;

            $analytics[$instrument][$prodi][$kategori] = $row->rata_rata;
        }

        $kategoriPerInstrumen = [];
        foreach ($raw as $row) {
            $kategoriPerInstrumen[$row->nama_instrumen][] = $row->nama_kategori;
        }

        foreach ($kategoriPerInstrumen as $instrumen => $kategori) {
            $kategoriPerInstrumen[$instrumen] = collect($kategori)
                ->unique()
                ->values();
        }

        $page = "Analytics";
        $judul = "Analytics Per Instrumen";
        $subjudul = "Rerata Per Indikator Survey Per Program Studi";

        return view(
            "analytics.per-instrumen",
            compact(
                "analytics",
                "kategoriPerInstrumen",
                "page",
                "judul",
                "subjudul",
            ),
        );
    }

    public function laporanFakultas()
    {
        $raw = DB::table("survey_answers")

            ->join(
                "survey_instruments",
                "survey_answers.instrument_id",
                "=",
                "survey_instruments.id",
            )
            ->join(
                "survey_sessions",
                "survey_answers.session_id",
                "=",
                "survey_sessions.id",
            )
            ->join(
                "mahasiswa",
                "survey_sessions.mahasiswa_id",
                "=",
                "mahasiswa.id",
            )
            ->join("prodi", "mahasiswa.prodi_id", "=", "prodi.id")
            ->select(
                "prodi.nama_prodi",
                "survey_instruments.id as instrument_id",
                "survey_instruments.nama_instrumen",
                DB::raw("ROUND(AVG(survey_answers.jawaban),2) as rata_rata"),
            )
            ->groupBy(
                "prodi.nama_prodi",
                "survey_instruments.id",
                "survey_instruments.nama_instrumen",
            )
            ->orderBy("prodi.nama_prodi")
            ->orderBy("survey_instruments.id")
            ->get();

        $instrumen = $raw->pluck("nama_instrumen")->unique()->values();

        $pivot = [];

        foreach ($raw as $row) {
            $pivot[$row->nama_prodi][$row->nama_instrumen] = $row->rata_rata;
        }

        foreach ($pivot as $prodi => $nilai) {
            $total = 0;
            $jumlah = 0;

            foreach ($instrumen as $item) {
                $value = $nilai[$item] ?? 0;
                if ($value > 0) {
                    $total += $value;
                    $jumlah++;
                }
            }

            $pivot[$prodi]["RERATA_FAKULTAS"] =
                $jumlah > 0 ? round($total / $jumlah, 2) : 0;
        }

        $ikmFakultas = DB::table("survey_answers")->avg("jawaban");
        $ikmFakultas = round($ikmFakultas, 2);
        $page = "Analytics";
        $judul = "Laporan Fakultas";
        $subjudul = "Rerata Survey Seluruh Program Studi";

        $prodiLabels = [];
        $prodiSeries = [];

        foreach ($pivot as $prodi => $nilai) {
            $prodiLabels[] = $prodi;
            $prodiSeries[] = $nilai["RERATA_FAKULTAS"];
        }

        $chartLabels = [];
        $chartSeries = [];

        foreach ($pivot as $prodi => $nilai) {
            $chartLabels[] = $prodi;
            $chartSeries[] = $nilai["RERATA_FAKULTAS"];
        }

        return view(
            "analytics.fakultas",
            compact(
                "pivot",
                "instrumen",
                "ikmFakultas",
                "page",
                "judul",
                "subjudul",
                "prodiLabels",
                "prodiSeries",
                "chartLabels",
                "chartSeries",
            ),
        );
    }
}
