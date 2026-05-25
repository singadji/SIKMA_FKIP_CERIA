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
                        <label class="form-label">Nama Program Studi</label>
                        <input type="text"
                            name="nama_prodi"
                            class="form-control @error('nama_prodi') is-invalid @enderror"
                            value="{{ old('nama_prodi', $item->nama_prodi ?? '') }}">
                        @error('nama_prodi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jurusan</label>
                        <select name="jurusan_id" class="form-control">
                            <option>-- Pilih Jurusan --</option>
                            @foreach($jurusan as $j)
                                <option value="{{ $j->id }}"
                                    {{ old('jurusan_id', $item->jurusan_id ?? '') == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama_jurusan }}
                                </option>
                            @endforeach
                        </select>
                        @error('jurusan_id')
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
