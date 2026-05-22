@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="card-title">{{ $subjudul }}</h4>
                            <p class="card-title-desc"></p>
                        </div>
                        <div class="col-lg-6">
                            {!! $btn !!}
                        </div>
                    </div>
                </div>
            <form role="form" method="POST" action="{{ $aksi }}" enctype="multipart/form-data">
                @csrf
                @if(isset($item))
                    @method('PUT')
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" placeholder="" @if(isset($item)) value="{{ $item->name }}" @else value="{{ old('nama') }}" @endif required">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">e-Mail / UserID</label>
                                <input type="email" class="form-control @if(isset($item)) @error('email') is-invalid @enderror @endif" name="email" placeholder="" @if(isset($item)) value="{{ $item->email }}" @else value="{{ old('email') }}" @endif required">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password <font style="color:red; font-size:9pt">(minimal 8 karakter, terdiri dari angka dan huruf kapital)</font> </label>
                                <input type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password"
                                    name="password_confirmation"
                                    class="form-control">
                            </div>
                            
                        <div class="mb-3">
                            <label class="form-label">Aktif</label>
                            <br><input type="checkbox" id="switch6" switch="success" name="publish" value="1" @if(isset($item)&& $item->aktif == '1') checked @endif />
                            <label for="switch6" data-on-label="Ya" data-off-label="Tidak"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection