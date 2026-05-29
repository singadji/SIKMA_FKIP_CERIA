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
                        <label class="form-label">Instrumen</label>
                        <select name="instrument_id" class="form-select @error('instrument_id') is-invalid @enderror">
                            <option value="">Pilih Instrumen</option>
                            @foreach($instrumen as $instrumenItem)
                                <option value="{{ $instrumenItem->id }}" {{ old('instrument_id', $item->instrument_id ?? '') == $instrumenItem->id ? 'selected' : '' }}>{{ $instrumenItem->nama_instrumen }}</option>
                            @endforeach
                        </select>
                        @error('instrument_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text"
                            name="nama_kategori"
                            class="form-control @error('nama_kategori') is-invalid @enderror"
                            value="{{ old('nama_kategori', $item->nama_kategori ?? '') }}">
                        @error('nama_kategori')
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
