<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\SurveySession;
use App\Models\SurveyInstrument;
use App\Models\SurveyAnswer;
use App\Models\SurveyQuestion;

class SurveyController extends Controller
{
    public function index()
    {
        return view("survey.index");
    }

    public function cekNim(Request $request)
    {
        $request->validate([
            "nim" => "required",
        ]);

        $mahasiswa = Mahasiswa::with("prodi")
            ->where("nim", $request->nim)
            ->where("status_aktif", 1)
            ->first();

        if (!$mahasiswa) {
            return back()->with("error", "NIM tidak terdaftar");
        }

        return redirect("/survey/biodata/" . $mahasiswa->nim);
    }

    public function biodata($nim)
    {
        $mahasiswa = Mahasiswa::with("prodi")
            ->where("nim", $nim)
            ->firstOrFail();
        return view("survey.biodata", compact("mahasiswa"));
    }

    public function storeBiodata(Request $request)
    {
        $mahasiswa = Mahasiswa::findOrFail($request->mahasiswa_id);

        /*
        |--------------------------------------------------------------------------
        | CEK DOUBLE SURVEY
        |--------------------------------------------------------------------------
        */

        $cek = SurveySession::where("mahasiswa_id", $mahasiswa->id)
            ->where("tahun_akademik", "2025/2026")
            ->exists();

        if ($cek) {
            return back()->with("error", "Anda sudah mengisi survey");
        }

        /*
        |--------------------------------------------------------------------------
        | BUAT SESSION SURVEY
        |--------------------------------------------------------------------------
        */

        $instrumentId = SurveyInstrument::first()->id;

        $session = SurveySession::create([
            "mahasiswa_id" => $mahasiswa->id,
            "tahun_akademik" => "2025/2026",
            "semester" => "Genap",
            "tanggal_survey" => now(),
            "status_selesai" => false,
        ]);

        return redirect(
            "/survey/instrumen/" . $session->id . "/" . $instrumentId,
        );
    }

    public function instrumen($sessionId, $instrumentId)
    {
        $session = SurveySession::findOrFail($sessionId);
        $instrument = SurveyInstrument::with([
            "categories.questions",
        ])->findOrFail($instrumentId);

        $progress = 0;
        if ($instrumentId == 1) {
            $progress = 33;
        }

        if ($instrumentId == 2) {
            $progress = 66;
        }

        if ($instrumentId == 3) {
            $progress = 100;
        }

        return view(
            "survey.instrumen",
            compact("session", "instrument", "progress"),
        );
    }

    public function storeJawaban(Request $request)
    {
        $request->validate([
            "session_id" => "required",
            "instrument_id" => "required",
            "jawaban" => "required|array",
        ]);

        $totalPertanyaan = SurveyQuestion::where(
            "instrument_id",
            $request->instrument_id,
        )->count();

        $totalJawaban = count($request->jawaban);

        if ($totalJawaban < $totalPertanyaan) {
            return back()
                ->with(
                    "error",
                    "Semua pertanyaan pada instrumen ini wajib diisi.",
                )
                ->withInput();
        }

        if ($request->instrument_id == 1) {
            $request->validate([
                "dosen" => "required",

                "mata_kuliah" => "required",
            ]);
        }

        foreach ($request->jawaban as $questionId => $value) {
            $question = SurveyQuestion::find($questionId);

            $existing = SurveyAnswer::where([
                "session_id" => $request->session_id,
                "question_id" => $questionId,
            ])->first();

            if (!$existing) {
                SurveyAnswer::create([
                    "session_id" => $request->session_id,
                    "instrument_id" => $question->instrument_id,
                    "question_id" => $questionId,
                    "jawaban" => $value,
                    "dosen_id" => $request->dosen_id,
                    "mata_kuliah_id" => $request->mata_kuliah_id,
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | NEXT INSTRUMEN
        |--------------------------------------------------------------------------
        */

        $next = $request->instrument_id + 1;

        if ($next <= 3) {
            return redirect(
                "/survey/instrumen/" . $request->session_id . "/" . $next,
            );
        }

        /*
        |--------------------------------------------------------------------------
        | SELESAIKAN SURVEY
        |--------------------------------------------------------------------------
        */

        $session = SurveySession::find($request->session_id);

        $session->update([
            "status_selesai" => true,
        ]);

        return redirect("/survey/selesai");
    }

    public function selesai()
    {
        return view("survey.selesai");
    }
}
