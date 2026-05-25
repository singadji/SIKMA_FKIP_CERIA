<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ModulRequest;
use App\Models\Modul;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $btn =
            '<a href="' .
            route("modul.create") .
            '"
             class="btn btn-primary btn-sm float-end ms-2">
             <i class="fa fa-plus-circle"></i> Modul Baru</a>';

        $page = "Content Management";
        $judul = "Modul";
        $subjudul = "Administrasi Modul";

        $modul = Modul::with("parent")
            ->orderBy("par")
            ->orderBy("nama_modul")
            ->get();

        return view("admin.modul.index", [
            "item" => $modul,
            "btn" => $btn,
            "page" => $page,
            "judul" => $judul,
            "subjudul" => $subjudul,
        ]);
    }

    public function edit(Modul $modul)
    {
        $btn =
            ' &nbsp;<a href="' .
            route("modul.index") .
            '" class="btn btn-info btn-sm" style="float: right;margin-left:3px;"><i class="fa fa-chevron-left"></i> Kembali</a>&nbsp;';
        $page = "Content Management";
        $judul = "Modul";
        $subjudul = "Administrasi Modul - Edit Modul";
        $aksi = route("modul.update", $modul->uuid);

        return view("admin.modul.form", [
            "aksi" => $aksi,
            "parent" => Modul::whereNull("par")->get(),
            "roles" => \Spatie\Permission\Models\Role::all(),
            "subjudul" => "Edit Modul",
            "item" => $modul,
            "btn" => $btn,
            "page" => $page,
            "judul" => $judul,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $btn =
            ' &nbsp;<a href="' .
            route("modul.index") .
            '" class="btn btn-info btn-sm" style="float: right;margin-left:3px;"><i class="fa fa-chevron-left"></i> Kembali</a>&nbsp;        ';
        $page = "Content Management";
        $judul = "modul";
        $subjudul = "Administrasi Modul - Tambah Modul Baru";
        $aksi = route("modul.store");

        return view("admin.modul.form", [
            "aksi" => route("modul.store"),
            "parent" => Modul::whereNull("par")->get(),
            "roles" => \Spatie\Permission\Models\Role::all(),
            "subjudul" => "Tambah Modul",
            "btn" => $btn,
            "page" => $page,
            "judul" => $judul,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ModulRequest $request)
    {
        $data = $request->validated();

        $data["slug"] = $data["slug"] ?? Str::slug($data["nama_modul"]);

        $data["aktif"] = $request->has("aktif") ? 1 : 0;

        $data["created_by"] = auth()->id();

        Modul::create($data);

        return redirect()
            ->route("modul.index")
            ->with("success", "Berhasil menambahkan modul.");
    }

    /**
     * Display the specified resource.
     */
    public function show() {}

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ModulRequest $request,
        Modul $modul,
    ): RedirectResponse {
        $data = $request->validated();

        $data["aktif"] = $request->has("aktif") ? 1 : 0;

        $modul->update($data);

        return redirect()
            ->route("modul.index")
            ->with("success", "Data berhasil diupdate");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modul $modul)
    {
        $modul->delete();

        return redirect()
            ->route("modul.index")
            ->with("success", "Data berhasil dihapus.");
    }

    public function aktif(Modul $modul)
    {
        $modul->update(["aktif" => 1]);

        return response()->json([
            "message" => "Berhasil diaktifkan",
        ]);
    }

    public function nonaktif(Modul $modul)
    {
        $modul->update(["aktif" => 0]);

        return response()->json([
            "message" => "Berhasil dinonaktifkan",
        ]);
    }
}
