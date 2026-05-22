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

                    {{-- KATEGORI UNSUR --}}
                    <div class="mb-3">
                        <label class="form-label">Kategori Unsur</label>
                        <select name="kategori_unsur_id" class="form-control">
                            <option>-- Kategori Unsur --</option>
                            @foreach($kategori_unsur as $p)
                                <option value="{{ $p->id }}"
                                    {{ old('kategori_unsur_id', $item->kategori_unsur_id ?? '') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_kategori_unsur }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- NAMA KATEGORI --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Sub Unsur</label>
                        <input type="text"
                            name="nama_sub_unsur"
                            class="form-control @error('nama_sub_unsur') is-invalid @enderror"
                            value="{{ old('nama_sub_unsur', $item->nama_sub_unsur ?? '') }}"
                            placeholder="Contoh: Urusan Wajib">

                        @error('nama_sub_unsur')
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
