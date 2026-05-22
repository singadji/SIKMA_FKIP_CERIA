@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card">
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


            <form method="POST" action="{{ $aksi }}">
                @csrf
                @if(isset($item))
                    @method('PUT')
                @endif

                <div class="card-body">

                    {{-- Nama Modul --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Modul</label>
                        <input type="text"
                            name="nama_modul"
                            class="form-control @error('nama_modul') is-invalid @enderror"
                            value="{{ old('nama_modul', $item->nama_modul ?? '') }}">
                        @error('nama_modul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- URL --}}
                    <div class="mb-3">
                        <label class="form-label">URL</label>
                        <input type="text"
                            name="url"
                            class="form-control @error('url') is-invalid @enderror"
                            value="{{ old('url', $item->url ?? '') }}"
                            placeholder="/dashboard">
                    </div>

                    {{-- ICON --}}
                    <div class="mb-3">
                        <label class="form-label">Icon (<a href="https://mannatthemes.com/dastone/default/icons-feather.html" target="_blank">https://mannatthemes.com/dastone/default/icons-feather.html</a>)</label>
                        <input type="text"
                            name="icon"
                            class="form-control"
                            value="{{ old('icon', $item->icon ?? '') }}"
                            placeholder="fas fa-home">
                    </div>

                    {{-- PARENT --}}
                    <div class="mb-3">
                        <label class="form-label">Parent Modul</label>
                        <select name="par" class="form-control">
                            <option value="">-- Parent --</option>
                            @foreach($parent as $p)
                                <option value="{{ $p->id }}"
                                    {{ old('par', $item->par ?? '') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_modul }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- ROLE --}}
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role_id" class="form-control">
                            <option value="">-- Semua Role --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}"
                                    {{ old('role_id', $item->role_id ?? '') == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- FOLDER --}}
                    <div class="mb-3">
                        <label class="form-label">Folder</label>
                        <input type="text"
                            name="folder"
                            class="form-control"
                            value="{{ old('folder', $item->folder ?? '') }}">
                    </div>

                    {{-- STATUS --}}
                    <div class="row">

                        <div class="col-md-6">
                            <label class="form-label d-block">Aktif</label>
                            <input type="checkbox" id="switch6" switch="success"
                            name="aktif" value="1"
                            {{ old('aktif', $item->aktif ?? 0) ? 'checked' : '' }}>
                        <label for="switch6" data-on-label="Ya" data-off-label="Tidak"></label>
                        </div>

                    </div>

                </div>

                <div class="card-footer">
                    <button class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>
@endsection
