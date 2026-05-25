<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SurveyInstrument;
use App\Http\Requests\StoreInstrumentRequest;
use Masterminds\HTML5\InstructionProcessor;
use App\Http\Requests\InstrumenRequest;

class InstrumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $btn =
            '<a href="' .
            route("instrument.create") .
            '" class="btn btn-primary btn-sm float-end ms-2">
                     <i class="fa fa-plus-circle"></i> Instrument Baru</a>';

        $page = "Content Management";
        $judul = "Instrument";
        $subjudul = "Administrasi Instrument";

        $item = SurveyInstrument::all();
        return view(
            "admin.instrument.index",
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
            route("instrument.index") .
            '" class="btn btn-info btn-sm" style="float: right;margin-left:3px;"><i class="fa fa-chevron-left"></i> Kembali</a>&nbsp;';

        $page = "Content Management";
        $judul = "Instrument";
        $subjudul = "Administrasi Instrument - Tambah Instrumen";

        $aksi = route("instrument.store");

        return view(
            "admin.instrument.form",
            compact("page", "judul", "subjudul", "btn", "aksi"),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InstrumenRequest $request)
    {
        $data = $request->validated();
        $data["created_by"] = auth()->id();

        SurveyInstrument::create($data);
        return redirect()
            ->route("instrument.index")
            ->with("success", "Instrument berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = SurveyInstrument::findOrFail($id);
        return view("admin.instrument.show", compact("item"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SurveyInstrument $instrument)
    {
        $item = $instrument;

        $btn =
            ' &nbsp;<a href="' .
            route("instrument.index") .
            '" class="btn btn-info btn-sm" style="float: right;margin-left:3px;"><i class="fa fa-chevron-left"></i> Kembali</a>&nbsp;';

        $page = "Content Management";
        $judul = "Instrument";
        $subjudul = "Administrasi Instrument - Edit Data";

        $aksi = route("instrument.update", $instrument);

        return view(
            "admin.instrument.form",
            compact("page", "judul", "subjudul", "item", "aksi", "item", "btn"),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        InstrumenRequest $request,
        SurveyInstrument $instrument,
    ) {
        $data = $request->validated();
        $instrument->update($data);
        return redirect()
            ->route("instrument.index")
            ->with("success", "Instrument berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SurveyInstrument $instrument)
    {
        $instrument->delete();
        return redirect()
            ->route("instrument.index")
            ->with("success", "Instrument berhasil dihapus.");
    }

    public function aktif(SurveyInstrument $instrument)
    {
        $instrument->update(["is_active" => true]);
        return redirect()
            ->route("instrument.index")
            ->with("success", "Instrument berhasil diaktifkan.");
    }

    public function nonaktif(SurveyInstrument $instrument)
    {
        $instrument->update(["is_active" => false]);
        return redirect()
            ->route("instrument.index")
            ->with("success", "Instrument berhasil dinonaktifkan.");
    }
}
