<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;

Route::get("/", function () {
    return view("welcome");
});

Route::middleware(["auth", "role:admin|gjm"])->group(function () {
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
});

Route::get("/", [SurveyController::class, "index"]);
Route::post("/cek-nim", [SurveyController::class, "cekNim"])->name(
    "survey.cek-nim",
);

Route::get("/survey/biodata/{nim}", [SurveyController::class, "biodata"]);
Route::post("/survey/biodata/store-biodata", [
    SurveyController::class,
    "storeBiodata",
])->name("storeBiodata");

Route::get("/survey/instrumen/{session}/{instrument}", [
    SurveyController::class,
    "instrumen",
])->name("instrumen");

Route::post("/survey/store-jawaban", [
    SurveyController::class,
    "storeJawaban",
])->name("survey.store-jawaban");

Route::get("/survey/selesai", [SurveyController::class, "selesai"]);

require __DIR__ . "/auth.php";
