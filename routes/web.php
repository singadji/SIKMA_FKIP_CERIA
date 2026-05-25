<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\InstrumentController;

Route::get("/", function () {
    return view("welcome");
});

Route::middleware(["auth"])->group(function () {
    Route::get("/dashboard", [DashboardController::class, "index"])->name(
        "dashboard",
    );

    Route::get("/laporan/pdf", [ReportController::class, "exportPdf"])->name(
        "laporan.pdf",
    );

    Route::get("/laporan/excel", [
        ReportController::class,
        "exportExcel",
    ])->name("laporan.excel");

    Route::get("/laporan/dosen", [
        ReportController::class,
        "laporanDosen",
    ])->name("laporan.dosen");

    Route::get("/laporan/prodi", [
        ReportController::class,
        "laporanProdi",
    ])->name("laporan.prodi");

    Route::get("/laporan/servqual", [
        ReportController::class,
        "laporanServqual",
    ])->name("laporan.servqual");

    Route::resource("modul", ModulController::class);

    Route::patch("/modul/{modul}/aktif", [
        ModulController::class,
        "aktif",
    ])->name("modul.aktif");

    Route::patch("/modul/{modul}/nonaktif", [
        ModulController::class,
        "nonaktif",
    ])->name("modul.nonaktif");

    Route::resource("prodi", ProdiController::class);
    Route::resource("instrument", InstrumentController::class);
    Route::patch("/instrument/{instrument}/aktif", [
        InstrumentController::class,
        "aktif",
    ])->name("instrument.aktif");

    Route::patch("/instrument/{instrument}/nonaktif", [
        InstrumentController::class,
        "nonaktif",
    ])->name("instrument.nonaktif");

    Route::resource("mahasiswa", MahasiswaController::class);
    Route::get("/mahasiswa/data", [MahasiswaController::class, "data"])->name(
        "mahasiswa.data",
    );
    Route::patch("/mahasiswa/{mahasiswa}/aktif", [
        MahasiswaController::class,
        "aktif",
    ])->name("mahasiswa.aktif");

    Route::patch("/mahasiswa/{mahasiswa}/nonaktif", [
        MahasiswaController::class,
        "nonaktif",
    ])->name("mahasiswa.nonaktif");
});

Route::get("/", [SurveyController::class, "index"])->name("survey.index");

Route::post("/cek-nim", [SurveyController::class, "cekNim"])->name(
    "survey.cek-nim",
);

Route::get("/survey/biodata/{mahasiswa}", [
    SurveyController::class,
    "biodata",
])->name("survey.biodata");

Route::post("/survey/biodata/store-biodata", [
    SurveyController::class,
    "storeBiodata",
])->name("storeBiodata");

Route::get("/survey/menu/{mahasiswa}", [SurveyController::class, "menu"])->name(
    "survey.menu",
);

Route::get("/survey/instrumen/{mahasiswa}/{instrument}", [
    SurveyController::class,
    "instrumen",
])->name("survey.instrumen");

Route::post("/survey/store-jawaban", [
    SurveyController::class,
    "storeJawaban",
])->name("survey.store-jawaban");

Route::get("/survey/selesai/{mahasiswa}", [
    SurveyController::class,
    "selesai",
])->name("survey.selesai");

require __DIR__ . "/auth.php";
