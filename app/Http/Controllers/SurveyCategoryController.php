<?php

namespace App\Http\Controllers;

use App\Models\SurveyCategory;
use App\Http\Requests\SurveyCategoryRequest;
use App\Models\SurveyInstrument;

class SurveyCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $btn =
            '<a href="' .
            route("kategori-survey.create") .
            '" class="btn btn-primary btn-sm float-end ms-2">
                     <i class="fa fa-plus-circle"></i> Kategori Baru</a>';

        $page = "Content Management";
        $judul = "Kategori Survey";
        $subjudul = "Administrasi Kategori Survey";

        $item = SurveyCategory::with("instrument")
            ->orderBy("instrument_id")
            ->orderBy("nama_kategori")
            ->get();

        return view(
            "admin.kategori.index",
            compact("item", "btn", "page", "judul", "subjudul"),
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $btn =
            ' &nbsp;<a href="' .
            route("kategori-survey.index") .
            '" class="btn btn-info btn-sm" style="float: right;margin-left:3px;"><i class="fa fa-chevron-left"></i> Kembali</a>&nbsp;';

        $page = "Content Management";
        $judul = "Kategori Survey";
        $subjudul = "Administrasi Kategori Survey - Tambah Data";

        $aksi = route("kategori-survey.store");

        $instrumen = SurveyInstrument::all();
        return view(
            "admin.kategori.form",
            compact("instrumen", "btn", "page", "judul", "subjudul", "aksi"),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SurveyCategoryRequest $request)
    {
        $data = $request->validated();
        $data["updated_by"] = auth()->id();

        SurveyCategory::create($data);
        return redirect()
            ->route("kategori-survey.index")
            ->with("success", "Kategori survey berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(SurveyCategory $surveyCategory)
    {
        return view("admin.kategori.show", compact("surveyCategory"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SurveyCategory $kategoriSurvey)
    {
        $item = $kategoriSurvey;

        $btn =
            ' &nbsp;<a href="' .
            route("kategori-survey.index") .
            '" class="btn btn-info btn-sm" style="float: right;margin-left:3px;"><i class="fa fa-chevron-left"></i> Kembali</a>&nbsp;';

        $page = "Content Management";
        $judul = "Kategori Survey";
        $subjudul = "Administrasi Kategori Survey - Edit Data";

        $aksi = route("kategori-survey.update", $kategoriSurvey);

        $instrumen = SurveyInstrument::all();
        return view(
            "admin.kategori.form",
            compact(
                "item",
                "btn",
                "page",
                "judul",
                "subjudul",
                "aksi",
                "instrumen",
            ),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SurveyCategoryRequest $request,
        SurveyCategory $kategoriSurvey,
    ) {
        $data = $request->validated();
        $kategoriSurvey->update($data);
        return redirect()
            ->route("kategori-survey.index")
            ->with("success", "Kategori survey berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SurveyCategory $kategoriSurvey)
    {
        $kategoriSurvey->delete();
        return redirect()
            ->route("kategori-survey.index")
            ->with("success", "Kategori survey berhasil dihapus.");
    }
}
