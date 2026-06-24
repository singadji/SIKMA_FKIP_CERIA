<?php

namespace App\Http\Controllers;

use App\Models\SurveyQuestion;
use App\Http\Request\SurveyQuestionRequest;

class QuestionSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $btn =
            '<a href="' .
            route("pertanyaan-survey.create") .
            '" class="btn btn-primary btn-sm float-end ms-2">
                     <i class="fa fa-plus-circle"></i> Kategori Baru</a>';

        $page = "Content Management";
        $judul = "Kategori Survey";
        $subjudul = "Administrasi Kategori Survey";

        $item = SurveyQuestion::with("category")->get();

        return view(
            "admin.pertanyaan.index",
            compact("item", "btn", "page", "judul", "subjudul"),
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SurveyQuestionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SurveyQuestionRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
