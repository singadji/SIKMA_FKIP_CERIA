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
                        <label class="form-label">N I M</label>
                        <input type="text"
                            name="nim"
                            class="form-control @error('nim') is-invalid @enderror"
                            value="{{ old('nim', $item->nim ?? '') }}">
                        @error('nim')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Mahasiswa</label>
                        <input type="text"
                            name="nama"
                            class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $item->nama ?? '') }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Program Studi</label>
                        <select name="prodi_id" class="form-control">
                            <option>-- Pilih Program Studi --</option>
                            @foreach($prodi as $j)
                                <option value="{{ $j->id }}"
                                    {{ old('prodi_id', $item->prodi_id ?? '') == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                        @error('prodi_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
