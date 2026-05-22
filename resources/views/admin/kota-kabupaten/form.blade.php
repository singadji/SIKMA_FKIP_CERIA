@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h4 class="card-title mb-0">
                            {{ isset($item) ? 'Edit Kota Kabupaten' : 'Tambah Kota Kabupaten' }}
                        </h4>
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

                    {{-- KODE PROVINSI --}}
                    <div class="mb-3">
                        <label class="form-label">Provinsi</label>
                        <select name="provinsi_id" class="form-control @error('provinsi_id') is-invalid @enderror">
                            <option value="">Pilih Provinsi</option>
                            @foreach($provinsi as $pro)
                                <option value="{{ $pro->id }}" {{ old('provinsi_id', $item->provinsi_id ?? '') == $pro->id ? 'selected' : '' }}>{{ $pro->provinsi }}</option>
                            @endforeach
                        </select>
                        @error('provinsi_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KODE KOTA KABUPATEN --}}
                    <div class="mb-3">
                        <label class="form-label">Kode Kota Kabupaten</label>
                        <input type="text"
                            name="id"
                            class="form-control @error('id') is-invalid @enderror"
                            value="{{ old('id', $item->id ?? '') }}">
                        @error('id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- NAMA KOTA KABUPATEN --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Kota Kabupaten</label>
                        <input type="text"
                            name="kota_kabupaten"
                            class="form-control @error('kota_kabupaten') is-invalid @enderror"
                            value="{{ old('kota_kabupaten', $item->kota_kabupaten ?? '') }}">
                        @error('kota_kabupaten')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- UPLOAD PETA --}}
                    <div class="mb-3">
                        <label class="form-label">Upload Peta</label>
                        <input type="file"
                            name="peta"
                            class="form-control">

                        @if(isset($item) && $item->peta)
                            <div class="mt-2">
                                <a href="{{ asset($item->peta) }}" target="_blank">
                                    Lihat Peta Saat Ini
                                </a>
                            </div>
                        @endif
                    </div>

                </div>

                <div class="card-footer text-left">
                    <button class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        {{ isset($item) ? 'Update' : 'Simpan' }}
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>
@endsection
