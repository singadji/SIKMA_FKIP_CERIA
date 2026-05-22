@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h4 class="card-title mb-0">
                            {{ isset($item) ? 'Edit Sub Urusan' : 'Sub Urusan Baru' }}
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

                    {{-- KATEGORI Urusan --}}
                    <div class="mb-3">
                        <label class="form-label">Kategori Urusan</label>
                        <select name="kategori_urusan_id" class="form-control">
                            <option>-- Kategori Urusan --</option>
                            @foreach($kategori_urusan as $p)
                                <option value="{{ $p->id }}"
                                    {{ old('kategori_urusan_id', $item->kategori_urusan_id ?? '') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_kategori_urusan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- NAMA KATEGORI --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Sub Urusan</label>
                        <input type="text"
                            name="nama_sub_urusan"
                            class="form-control @error('nama_sub_urusan') is-invalid @enderror"
                            value="{{ old('nama_sub_urusan', $item->nama_sub_urusan ?? '') }}"
                            placeholder="Contoh: Urusan Wajib">

                        @error('nama_sub_urusan')
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
