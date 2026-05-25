<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Http\Requests\MahasiswaRequest;
use Illuminate\Http\RedirectResponse;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item = Mahasiswa::select(
            "id",
            "uuid",
            "nim",
            "nama",
            "prodi_id",
            "status_aktif",
        )
            ->with(["prodi:id,nama_prodi"])
            ->where("status_aktif", 1)
            ->latest()
            ->get();

        $prodi = Prodi::with("jurusan")->get();
        $btn =
            '<a href="' .
            route("mahasiswa.create") .
            '" class="btn btn-primary btn-sm float-end ms-2">
             <i class="fa fa-plus-circle"></i> Mahasiswa Baru</a>';

        $page = "Content Management";
        $judul = "Mahasiswa";
        $subjudul = "Administrasi Mahasiswa";

        return view(
            "admin.mahasiswa.index",
            compact("btn", "page", "judul", "subjudul", "prodi", "item"),
        );
    }

    public function data()
    {
        $item = Mahasiswa::select("id", "uuid", "nim", "nama", "prodi_id")
            ->with(["prodi:id,nama_prodi"])
            ->where("status_aktif", 1)
            ->latest()
            ->get();
        return response()->json([
            "data" => $item,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = Prodi::with("jurusan")->get();
        $btn =
            ' &nbsp;<a href="' .
            route("mahasiswa.index") .
            '" class="btn btn-info btn-sm" style="float: right;margin-left:3px;"><i class="fa fa-chevron-left"></i> Kembali</a>&nbsp;';

        $page = "Content Management";
        $judul = "Mahasiswa";
        $subjudul = "Administrasi Mahasiswa - Tambah Data";

        $aksi = route("mahasiswa.store");
        return view(
            "admin.mahasiswa.form",
            compact("prodi", "btn", "page", "judul", "subjudul", "aksi"),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MahasiswaRequest $request)
    {
        $data = $request->validated();
        $data["created_by"] = auth()->id();
        Mahasiswa::create($data);
        return redirect()->route("mahasiswa.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view("mahasiswa.show", compact("mahasiswa"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $item = $mahasiswa;

        $prodi = Prodi::with("jurusan")->get();
        $btn =
            ' &nbsp;<a href="' .
            route("mahasiswa.index") .
            '" class="btn btn-info btn-sm" style="float: right;margin-left:3px;"><i class="fa fa-chevron-left"></i> Kembali</a>&nbsp;';

        $page = "Content Management";
        $judul = "Mahasiswa";
        $subjudul = "Administrasi Mahasiswa - Edit Data";

        $aksi = route("mahasiswa.update", $mahasiswa->uuid);

        return view(
            "admin.mahasiswa.form",
            compact(
                "item",
                "prodi",
                "btn",
                "page",
                "judul",
                "subjudul",
                "aksi",
            ),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        $data = $request->validated();
        $mahasiswa->update($data);
        return redirect()
            ->route("mahasiswa.index")
            ->with("success", "Data mahasiswa berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()
            ->route("mahasiswa.index")
            ->with("success", "Data mahasiswa berhasil dihapus.");
    }
}
