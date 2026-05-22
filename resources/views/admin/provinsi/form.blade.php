@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h4 class="card-title mb-0">
                            {{ isset($item) ? 'Edit Provinsi' : 'Tambah Provinsi' }}
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

                    <div class="mb-3">
                        <label class="form-label">Kode Provinsi</label>
                        <input type="text"
                            name="id"
                            class="form-control @error('id') is-invalid @enderror"
                            value="{{ old('id', $item->id ?? '') }}">
                        @error('id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Provinsi</label>
                        <input type="text"
                            name="provinsi"
                            class="form-control @error('provinsi') is-invalid @enderror"
                            value="{{ old('provinsi', $item->provinsi ?? '') }}">
                        @error('provinsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Polygon</label>
                        <textarea
                            name="peta"
                            rows="20"
                            class="form-control">{{ old('peta', $item->peta ?? '') }}</textarea>
                        @error('peta')
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
