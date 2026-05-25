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
                    <div class="mb-3">
                        <label class="form-label">Kode Instrumen</label>
                        <input type="text"
                            name="kode"
                            class="form-control @error('kode') is-invalid @enderror"
                            value="{{ old('kode', $item->kode ?? '') }}">
                        @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Instrumen</label>
                        <input type="text"
                            name="nama_instrumen"
                            class="form-control @error('nama_instrumen') is-invalid @enderror"
                            value="{{ old('nama_instrumen', $item->nama_instrumen ?? '') }}">
                        @error('nama_instrumen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <input type="text"
                            name="deskripsi"
                            class="form-control @error('deskripsi') is-invalid @enderror"
                            value="{{ old('deskripsi', $item->deskripsi ?? '') }}">
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label d-block">Aktif</label>
                        <input type="checkbox" id="switch6" switch="success"
                        name="is_active" value="1"
                        {{ old('is_active', $item->is_active ?? 0) ? 'checked' : '' }}>
                    <label for="switch6" data-on-label="Ya" data-off-label="Tidak"></label>
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
