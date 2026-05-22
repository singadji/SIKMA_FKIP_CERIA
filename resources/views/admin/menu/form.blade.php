@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">

            {{-- HEADER --}}
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h4 class="card-title mb-0">{{ $subjudul }}</h4>
                    </div>
                    <div class="col-lg-6 text-end">
                        {!! $btn !!}
                    </div>
                </div>
            </div>

            {{-- FORM --}}
            <form method="POST" action="{{ $aksi }}" enctype="multipart/form-data">
                @csrf
                @isset($item)
                    @method('PUT')
                @endisset

                <div class="card-body">
                    <div class="row">

                        {{-- NAMA MENU --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Menu</label>
                            <input type="text"
                                name="nama_menu"
                                class="form-control @error('nama_menu') is-invalid @enderror"
                                value="{{ old('nama_menu', $item->nama_menu ?? '') }}">
                            @error('nama_menu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- PARENT --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Parent</label>
                            <select name="parent"
                                class="form-select @error('parent') is-invalid @enderror">
                                <option value="0">-</option>
                                @foreach($parent as $row)
                                    <option value="{{ $row->id_menu }}"
                                        {{ old('parent', $item->id_parent ?? 0) == $row->id_menu ? 'selected' : '' }}>
                                        {{ $row->nama_menu }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- LINK MENU --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Link</label>
                            <input type="text"
                                name="link_menu"
                                class="form-control"
                                value="{{ old('link_menu', $item->link_menu ?? '') }}"
                                placeholder="contoh: destinasi/wisata-alam">
                        </div>

                        {{-- POSISI --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Posisi</label>
                            <input type="number"
                                name="posisi"
                                class="form-control"
                                value="{{ old('posisi', $item->posisi ?? '') }}"
                                required>
                        </div>

                        {{-- ISI MENU --}}
                        <div class="col-12 mb-3">
                            <label class="form-label">Isi Menu</label>
                            <textarea id="ckeditor-classic"
                                name="isi_menu"
                                rows="20"
                                class="form-control">{{ old('isi_menu', $item->isi_menu ?? '') }}</textarea>
                        </div>

                        {{-- GAMBAR --}}
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Gambar</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            @isset($item->image)
                                <img src=""
                                     class="img-fluid mt-2"
                                     style="max-width:200px;">
                            @endisset
                        </div>

                        {{-- VIDEO --}}
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Video</label>
                            <input type="file" name="video" class="form-control" accept="video/*">
                            @isset($item->video)
                                <small class="text-muted">{{ $item->video }}</small>
                            @endisset
                        </div>

                        {{-- FILE --}}
                        <div class="col-md-3 mb-3">
                            <label class="form-label">File</label>
                            <input type="file" name="dokumen" class="form-control" accept=".pdf,.doc">
                            @isset($item->dokumen)
                                <small class="text-muted">{{ $item->dokumen }}</small>
                            @endisset
                        </div>

                        {{-- YOUTUBE --}}
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Link Youtube</label>
                            <input type="text"
                                name="link_youtube"
                                class="form-control"
                                value="{{ old('link_youtube', $item->link_youtube ?? '') }}">
                        </div>

                        {{-- HEADER IMAGE --}}
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Gambar Header</label>
                            <input type="file" name="gambar_header" class="form-control" accept="image/*">
                            @isset($item->gambar_header)
                                <img src="{{ asset('images/menu/header/'.$item->gambar_header) }}"
                                     class="img-fluid mt-2"
                                     style="max-width:200px;">
                            @endisset
                        </div>

                        {{-- PUBLISH --}}
                        <div class="col-12 mb-3">
                            <label class="form-label d-block">Aktif</label>
                            <input type="checkbox" id="switch6" switch="success"
                            name="publish" value="1"
                            {{ old('publish', $item->publish ?? 0) ? 'checked' : '' }}>
                        <label for="switch6" data-on-label="Ya" data-off-label="Tidak"></label>
                        </div>

                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
