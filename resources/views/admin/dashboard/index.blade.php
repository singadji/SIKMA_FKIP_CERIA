@extends('layouts.app')
@section('title', 'Dashboard RPJMD')
    @push('styles')
        <link rel="stylesheet" href="{{ asset('assets/dashboard/dashboard-rpjmd.css') }}" />
    @endpush

    @section('content')
        <div class="container-fluid py-4 dashboard-wrapper">
            <div class="card dashboard-card mb-4">
                <div class="card-body p-4">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-3">
                            <label class="form-label fw-semibold">Tahun RPJMD</label>
                            <select id="tahunFilter" class="form-select">
                                <option value="">Semua Tahun</option>
                                    @foreach($tahunList as $tahun)
                                        <option value="{{ $tahun }}" {{ $loop->first ? 'selected' : '' }}>{{ $tahun }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label fw-semibold">Provinsi</label>
                            <select id="provinsiSelect" class="form-select">
                                <option value="">Semua Provinsi</option>
                                    @foreach($provinsi as $item)
                                        <option value="{{ $item->id }}">{{ $item->provinsi }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <label class="form-label fw-semibold">Kabupaten / Kota</label>
                            <select id="kabupatenSelect" class="form-select">
                                <option value="">Semua Kabupaten/Kota</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <button id="filterButton" class="btn btn-primary w-100">Lihat</button>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-pills mb-4" id="dashboardTabs" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#summaryTab">Ringkasan</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#utamaTab">Kegiatan Utama</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#penunjangTab">Kegiatan Penunjang</button>
                </li>

                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#matrixTab">Matrix Analytics</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#gisTab">GIS Analytics</button>
                </li>
            </ul>
            <div class="tab-content">
                @include('admin.dashboard.tabs.summary')
                @include('admin.dashboard.tabs.utama')
                @include('admin.dashboard.tabs.penunjang')
                @include('admin.dashboard.tabs.matrix')
                @include('admin.dashboard.tabs.gis')
            </div>

        </div>

    @endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.45.2"></script>
    <script src="{{ asset('assets/dashboard/dashboard-rpjmd.js') }}"></script>
@endpush
