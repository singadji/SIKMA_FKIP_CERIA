@extends('layouts.survey')
@section('title', 'Menu Survey')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Dashboard Survey Mahasiswa</h1>
            <p class="text-muted">Pilih jenis survey yang ingin diisi</p>
        </div>
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-1 text-center">
                        <div class="avatar-lg mx-auto">
                            <div class="avatar-title bg-primary rounded-circle">
                                <i class="bi bi-person-fill fs-1 text-white"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <h3 class="fw-bold mb-1">
                            {{ $mahasiswa->nama }}
                        </h3>
                        <div class="row">
                            <div class="col-md-4">
                                <small class="text-muted">
                                    NIM
                                </small>
                                <div class="fw-semibold">
                                    {{ $mahasiswa->nim }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">
                                    Program Studi
                                </small>
                                <div class="fw-semibold">
                                    {{ $mahasiswa->prodi->nama_prodi ?? '-' }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">
                                    Jurusan
                                </small>
                                <div class="fw-semibold">
                                    {{ $mahasiswa->jurusan->nama_jurusan ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card survey-card h-100">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <i class="bi bi-person-video3 display-3 text-primary"></i>
                        </div>
                        <h4 class="fw-bold">Evaluasi Dosen</h4>
                        <p class="text-muted">Penilaian dosen dan mata kuliah</p>
                        <div class="mt-4">
                            <a href="{{ route('survey.instrumen', [$mahasiswa->uuid, 1]) }}" class="btn btn-sikma">Isi Survey</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card survey-card h-100">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <i class="bi bi-building display-3 text-success"></i>
                        </div>
                        <h4 class="fw-bold">Layanan Akademik</h4>
                        <p class="text-muted">Evaluasi layanan administrasi</p>
                        <div class="mt-4">
                            @if(!$instrumen1)
                                <button class="btn btn-secondary" disabled>Isi Survey</button>
                            @elseif($instrumen2)
                                <button class="btn btn-success" disabled>Sudah Diisi</button>
                            @else
                                <a href="{{ route('survey.instrumen', [$mahasiswa->uuid, 2]) }}" class="btn btn-sikma">Isi Survey</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            {{-- INSTRUMEN 3 --}}
            <div class="col-lg-4 mb-4">
                <div class="card survey-card h-100">
                    <div class="card-body text-center p-5">
                        <div class="mb-4">
                            <i class="bi bi-pc-display display-3 text-warning"></i>
                        </div>
                        <h4 class="fw-bold">Fasilitas Kampus</h4>
                        <p class="text-muted">Evaluasi sarana dan prasarana</p>
                        <div class="mt-4">
                            @if(!$instrumen2)
                                <button class="btn btn-secondary" disabled>Isi Survey</button>
                            @elseif($instrumen3)
                                <button class="btn btn-success" disabled>Sudah Diisi</button>
                            @else
                                <a href="{{ route('survey.instrumen', [$mahasiswa->uuid, 3]) }}" class="btn btn-sikma">Isi Survey</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
