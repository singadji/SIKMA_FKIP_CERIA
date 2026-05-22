@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h4 class="card-title mb-0">
                            {{ isset($item) ? 'Edit Kategori Unsur' : 'Kategori Unsur Baru' }}
                        </h4>
                    </div>
                    <div class="col-lg-6 text-end">
                        {!! $btn ?? '' !!}
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ $aksi }}">
                @csrf
                @if(isset($item))
                    @method('PUT')
                @endif

                <div class="card-body">

                    {{-- NAMA KATEGORI --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text"
                            name="nama_kategori_unsur"
                            class="form-control @error('nama_kategori_unsur') is-invalid @enderror"
                            value="{{ old('nama_kategori_unsur', $item->nama_kategori_unsur ?? '') }}"
                            placeholder="Contoh: Urusan Wajib">

                        @error('nama_kategori_unsur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
