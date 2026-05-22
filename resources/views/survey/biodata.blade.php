@extends('layouts.survey')

@section('title', 'Biodata Mahasiswa')
<div class="card border-0 shadow-lg rounded-4">

    <div class="card-body p-5">

        <div class="d-flex align-items-center mb-4">

            <div class="bg-primary text-white rounded-circle p-3 me-3">

                <i class="bi bi-person-fill fs-3"></i>

            </div>

            <div>

                <h3 class="fw-bold mb-0">
                    Biodata Mahasiswa
                </h3>

                <small class="text-muted">
                    Pastikan data mahasiswa sudah benar
                </small>

            </div>

        </div>
<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-body">

                    @if(session('error'))

                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>

                    @endif

                    <form method="POST" action="./store-biodata">
                        @csrf
                        <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->id }}">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>NIM</label>
                                <input type="text" class="form-control form-control-lg rounded-3" value="{{ $mahasiswa->nim }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Nama</label>
                                <input type="text" class="form-control form-control-lg rounded-3" value="{{ $mahasiswa->nama }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Jurusan</label>
                                <input type="text" class="form-control form-control-lg rounded-3" value="{{ $mahasiswa->prodi->jurusan->nama_jurusan }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Program Studi</label>
                                <input type="text" class="form-control form-control-lg rounded-3" value="{{ $mahasiswa->prodi->nama_prodi }}" readonly>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-lg rounded-3 px-5">
                            Lanjut Survey
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
