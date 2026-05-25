<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Jurusan;
use App\Http\Requests\ProdiRequest;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item = Prodi::all();
        $btn =
            '<a href="' .
            route("prodi.create") .
            '" class="btn btn-primary btn-sm float-end ms-2">
             <i class="fa fa-plus-circle"></i> Prodi Baru</a>';

        $page = "Content Management";
        $judul = "Program Studi";
        $subjudul = "Administrasi Program Studi dan Jurusan";

        return view(
            "admin.prodi.index",
            compact("item", "btn", "page", "judul", "subjudul"),
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        $btn =
            '<a href="' .
            route("prodi.index") .
            '" class="btn btn-info btn-sm float-end ms-2">
             <i class="fa fa-chevron-left"></i> Kembali</a>';
        $page = "Content Management";
        $judul = "Program Studi";
        $subjudul =
            "Administrasi Program Studi dan Jurusan - Tambah Program Studi";
        $aksi = route("prodi.store");

        return view(
            "admin.prodi.form",
            compact("jurusan", "btn", "page", "judul", "subjudul", "aksi"),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdiRequest $request)
    {
        $prodi = Prodi::create($request->validated());

        return redirect()
            ->route("prodi.index")
            ->with("success", "Program studi berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prodi = Prodi::findOrFail($id);
        return view("admin.prodi.show", compact("prodi"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Prodi::findOrFail($id);
        $jurusan = Jurusan::all();
        $btn =
            ' &nbsp;<a href="' .
            route("prodi.index") .
            '" class="btn btn-info btn-sm" style="float: right;margin-left:3px;"><i class="fa fa-chevron-left"></i> Kembali</a>&nbsp;';
        $page = "Content Management";
        $judul = "Program Studi";
        $subjudul =
            "Administrasi Program Studi dan Jurusan - Edit Program Studi";
        $aksi = route("prodi.update", $item->id);

        return view(
            "admin.prodi.form",
            compact(
                "item",
                "btn",
                "page",
                "judul",
                "subjudul",
                "aksi",
                "jurusan",
            ),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdiRequest $request, Prodi $prodi)
    {
        $prodi->update($request->validated());
        return redirect()
            ->route("prodi.index")
            ->with("success", "Program studi berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();
        return redirect()
            ->route("prodi.index")
            ->with("success", "Prodi telah dihapus.");
    }
}
