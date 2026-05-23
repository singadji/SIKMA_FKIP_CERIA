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
        return redirect("/survey/menu/" . $mahasiswa->uuid);
    }

    public function biodata(Mahasiswa $mahasiswa)
    {
        return view("survey.biodata", compact("mahasiswa"));
    }

    public function storeBiodata(Request $request)
    {
        $mahasiswa = Mahasiswa::findOrFail($request->mahasiswa_id);
        $instrumentId = SurveyInstrument::first()->id;
        return redirect()->route("survey.menu", $mahasiswa->uuid);
    }

    public function instrumen(Mahasiswa $mahasiswa, $instrumentId)
    {
        //$mahasiswa = Mahasiswa::findOrFail($mahasiswaId);
        if ($instrumentId == 2 || $instrumentId == 3) {
            $cek = SurveyAnswer::whereHas("session", function ($q) use (
                $mahasiswa,
            ) {
                $q->where("mahasiswa_id", $mahasiswa->id);
            })
                ->where("instrument_id", $instrumentId)
                ->exists();

            if ($cek) {
                return redirect()
                    ->route("survey.menu", $mahasiswa->uuid)
                    ->with("error", "Instrumen sudah pernah diisi.");
            }
        }

        $instrument = SurveyInstrument::with([
            "categories.questions",
        ])->findOrFail($instrumentId);

        return view("survey.instrumen", compact("mahasiswa", "instrument"));
    }

    public function storeJawaban(Request $request)
    {
        $request->validate([
            "mahasiswa_id" => "required",
            "instrument_id" => "required",
            "jawaban" => "required|array",
        ]);

        $mahasiswa = Mahasiswa::findOrFail($request->mahasiswa_id);

        $totalPertanyaan = SurveyQuestion::where(
            "instrument_id",
            $request->instrument_id,
        )->count();

        $totalJawaban = count($request->jawaban);

        if ($totalJawaban < $totalPertanyaan) {
            return back()
                ->with("error", "Semua pertanyaan wajib diisi.")
                ->withInput();
        }

        if ($request->instrument_id == 1) {
            $request->validate([
                "dosen" => "required",
                "mata_kuliah" => "required",
            ]);

            $dosen = $this->normalizeText($request->dosen);
            $mataKuliah = $this->normalizeText($request->mata_kuliah);

            $cek = SurveyAnswer::whereHas("session", function ($q) use (
                $request,
            ) {
                $q->where("mahasiswa_id", $request->mahasiswa_id);
            })
                ->where("instrument_id", 1)
                ->whereRaw("LOWER(dosen) LIKE ?", ["%" . $dosen . "%"])
                ->whereRaw("LOWER(mata_kuliah) LIKE ?", [
                    "%" . $mataKuliah . "%",
                ])
                ->exists();

            if ($cek) {
                return back()->with(
                    "error",
                    "Anda sudah menilai dosen dan mata kuliah ini.",
                );
            }
        }

        if ($request->instrument_id == 2 || $request->instrument_id == 3) {
            $cek = SurveyAnswer::whereHas("session", function ($q) use (
                $request,
            ) {
                $q->where("mahasiswa_id", $request->mahasiswa_id);
            })
                ->where("instrument_id", $request->instrument_id)
                ->exists();
            if ($cek) {
                return back()->with(
                    "error",
                    "Instrumen ini sudah pernah diisi.",
                );
            }
        }

        $periode = $this->getAcademicPeriod();

        $session = SurveySession::create([
            "mahasiswa_id" => $request->mahasiswa_id,
            "tahun_akademik" => $periode["tahun_akademik"],
            "semester" => $periode["semester"],
            "tanggal_survey" => now(),
            "status_selesai" => true,
        ]);

        foreach ($request->jawaban as $questionId => $value) {
            $question = SurveyQuestion::find($questionId);
            SurveyAnswer::create([
                "session_id" => $session->id,
                "instrument_id" => $question->instrument_id,
                "question_id" => $questionId,
                "jawaban" => $value,
                "dosen_id" => $request->dosen_id,
                "mata_kuliah_id" => $request->mata_kuliah_id,
                "dosen" => $request->dosen,
                "mata_kuliah" => $request->mata_kuliah,
            ]);
        }

        if ($request->instrument_id == 1) {
            $sudahInstrumen2 = SurveyAnswer::whereHas("session", function (
                $q,
            ) use ($request) {
                $q->where("mahasiswa_id", $request->mahasiswa_id);
            })
                ->where("instrument_id", 2)
                ->exists();
            if (!$sudahInstrumen2) {
                return redirect()
                    ->route("survey.instrumen", [$mahasiswa->uuid, 2])
                    ->with(
                        "success",
                        "Instrumen 1 berhasil disimpan. Silakan lanjut ke Instrumen 2.",
                    );
            }
            return redirect()
                ->route("survey.menu", [$mahasiswa->uuid])
                ->with("success", "Survey Instrumen 1 berhasil disimpan.");
        }

        if ($request->instrument_id == 2) {
            $sudahInstrumen3 = SurveyAnswer::whereHas("session", function (
                $q,
            ) use ($request) {
                $q->where("mahasiswa_id", $request->mahasiswa_id);
            })
                ->where("instrument_id", 3)
                ->exists();

            if (!$sudahInstrumen3) {
                return redirect()
                    ->route("survey.instrumen", [$mahasiswa->uuid, 3])

                    ->with(
                        "success",
                        "Instrumen 2 berhasil disimpan. Silakan lanjut ke Instrumen 3.",
                    );
            }

            return redirect()
                ->route("survey.menu", [$mahasiswa->uuid])

                ->with("success", "Survey Instrumen 2 berhasil disimpan.");
        }

        return redirect()
            ->route("survey.selesai")
            ->with("success", "Terima kasih telah mengisi survey.");
    }

    public function selesai()
    {
        return view("survey.selesai");
    }

    public function menu(Mahasiswa $mahasiswa)
    {
        //$mahasiswa = Mahasiswa::findOrFail($mahasiswaId);

        $instrumen1 = SurveyAnswer::whereHas("session", function ($q) use (
            $mahasiswa,
        ) {
            $q->where("mahasiswa_id", $mahasiswa->id);
        })
            ->where("instrument_id", 1)
            ->exists();

        $instrumen2 = SurveyAnswer::whereHas("session", function ($q) use (
            $mahasiswa,
        ) {
            $q->where("mahasiswa_id", $mahasiswa->id);
        })
            ->where("instrument_id", 2)
            ->exists();

        /*
        |--------------------------------------------------------------------------
        | STATUS INSTRUMEN 3
        |--------------------------------------------------------------------------
        */

        $instrumen3 = SurveyAnswer::whereHas("session", function ($q) use (
            $mahasiswa,
        ) {
            $q->where("mahasiswa_id", $mahasiswa->id);
        })
            ->where("instrument_id", 3)
            ->exists();

        return view(
            "survey.menu",
            compact("mahasiswa", "instrumen1", "instrumen2", "instrumen3"),
        );
    }

    /*
    |--------------------------------------------------------------------------
    | GET ACADEMIC PERIOD
    |--------------------------------------------------------------------------
    */

    private function getAcademicPeriod()
    {
        $bulan = now()->month;
        $tahun = now()->year;

        if ($bulan >= 7) {
            return [
                "semester" => "Gasal",
                "tahun_akademik" => $tahun . "/" . ($tahun + 1),
            ];
        }
        return [
            "semester" => "Genap",
            "tahun_akademik" => $tahun - 1 . "/" . $tahun,
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | NORMALIZE STRING
    |--------------------------------------------------------------------------
    */

    private function normalizeText($text)
    {
        $text = strtolower($text);

        /*
        |--------------------------------------------------------------------------
        | HAPUS SAPAAN
        |--------------------------------------------------------------------------
        */

        $remove = [
            "bp",
            "bpk",
            "bapak",
            "pak",
            "pa",
            "ibu",
            "bu",
            "ibuk",

            "dr",
            "dr.",
            "ir",
            "ir.",

            "s.pd",
            "m.pd",
            "s.kom",
            "m.kom",
        ];

        $text = str_replace($remove, "", $text);

        /*
        |--------------------------------------------------------------------------
        | HAPUS KARAKTER KHUSUS
        |--------------------------------------------------------------------------
        */

        $text = preg_replace("/[^a-z0-9\s]/", "", $text);

        /*
        |--------------------------------------------------------------------------
        | HAPUS SPASI BERLEBIH
        |--------------------------------------------------------------------------
        */

        $text = preg_replace("/\s+/", " ", $text);

        $text = trim($text);

        /*
        |--------------------------------------------------------------------------
        | AMBIL KATA PERTAMA SAJA
        |--------------------------------------------------------------------------
        */

        $words = explode(" ", $text);

        return $words[0] ?? $text;
    }
}
