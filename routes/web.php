<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\DashboardController;

Route::get("/", function () {
    return view("welcome");
});

Route::middleware("auth")->group(function () {
    Route::get("/dashboard", [DashboardController::class, "index"])->name(
        "dashboard",
    );

    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit",
    );
    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update",
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy",
    );
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
