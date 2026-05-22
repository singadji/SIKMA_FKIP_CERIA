@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="page-title-box d-sm-flex align-items-center justify-content-between">

    <h4 class="mb-sm-0">
        Dashboard SIKMA FKIP CERIA
    </h4>

</div>

<div class="card mb-4">

    <div class="card-body">

        <form class="row">

            <div class="col-md-4">

                <label>Tahun Akademik</label>

                <select class="form-select">

                    <option>2025/2026</option>

                </select>

            </div>

            <div class="col-md-4">

                <label>Program Studi</label>

                <select class="form-select">

                    <option>Semua Prodi</option>

                </select>

            </div>

            <div class="col-md-4 d-flex align-items-end">

                <button class="btn btn-primary">

                    Filter Data

                </button>

            </div>

        </form>

    </div>

</div>
<div class="row">

    {{-- TOTAL RESPONDEN --}}
    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">
                            Total Responden
                        </p>

                        <h4 class="mb-0">
                            {{ $totalResponden }}
                        </h4>

                    </div>

                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">

                        <span class="avatar-title">

                            <i class="mdi mdi-account-group font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- TOTAL MAHASISWA --}}
    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">
                            Mahasiswa
                        </p>

                        <h4 class="mb-0">
                            {{ $totalMahasiswa }}
                        </h4>

                    </div>

                    <div class="mini-stat-icon avatar-sm rounded-circle bg-success align-self-center">

                        <span class="avatar-title">

                            <i class="mdi mdi-school font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- TOTAL INSTRUMEN --}}
    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">
                            Instrumen
                        </p>

                        <h4 class="mb-0">
                            {{ $totalInstrumen }}
                        </h4>

                    </div>

                    <div class="mini-stat-icon avatar-sm rounded-circle bg-warning align-self-center">

                        <span class="avatar-title">

                            <i class="mdi mdi-clipboard-list font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- IKM --}}
    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">
                            Indeks Kepuasan
                        </p>

                        <h4 class="mb-0">
                            {{ $ikm }}%
                        </h4>

                    </div>

                    <div class="mini-stat-icon avatar-sm rounded-circle bg-danger align-self-center">

                        <span class="avatar-title">

                            <i class="mdi mdi-chart-line font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<div class="row">

    <div class="col-xl-6">

        <div class="card">

            <div class="card-header">

                <h4>
                    Radar SERVQUAL
                </h4>

            </div>

            <div class="card-body">

                <div id="radarChart"></div>

            </div>

        </div>

    </div>
    <div class="col-xl-6">

        <div class="card">

            <div class="card-header">

                <h4>
                    Distribusi Instrumen
                </h4>

            </div>

            <div class="card-body">

                <div id="pieChart"></div>

            </div>

        </div>

    </div>

    </div>
    <div class="row">

        <div class="col-xl-6">

            <div class="card">

                <div class="card-header">

                    <h4>
                        Kepuasan per Prodi
                    </h4>

                </div>

                <div class="card-body">

                    <div id="prodiChart"></div>

                </div>

            </div>

        </div>

        <div class="col-xl-6">

            <div class="card">

                <div class="card-header">

                    <h4>
                        Kepuasan Dosen
                    </h4>

                </div>

                <div class="card-body">

                    <div id="dosenChart"></div>

                </div>

            </div>

        </div>

    </div>
    <div class="card mt-4">

        <div class="card-header">

            <h4>
                Survey Terbaru
            </h4>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Tanggal</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($latestSurvey as $item)

                        <tr>

                            <td>
                                {{ $item->mahasiswa->nama }}
                            </td>

                            <td>
                                {{ $item->mahasiswa->nim }}
                            </td>

                            <td>
                                {{ $item->created_at }}
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>
    @push('scripts')

    <script>

    /*
    |--------------------------------------------------------------------------
    | RADAR CHART
    |--------------------------------------------------------------------------
    */

    var radarOptions = {

        series: [{
            name: 'Nilai',
            data: [
                @foreach($radar as $item)
                    {{ round($item->rata,2) }},
                @endforeach
            ]
        }],

        chart: {
            height: 350,
            type: 'radar'
        },

        xaxis: {
            categories: [
                @foreach($radar as $item)
                    "{{ $item->nama_kategori }}",
                @endforeach
            ]
        }
    };

    new ApexCharts(
        document.querySelector("#radarChart"),
        radarOptions
    ).render();

    /*
    |--------------------------------------------------------------------------
    | PIE CHART
    |--------------------------------------------------------------------------
    */

    var pieOptions = {

        series: [
            @foreach($instrumenChart as $item)
                {{ $item->total }},
            @endforeach
        ],

        chart: {
            type: 'pie',
            height: 350
        },

        labels: [
            @foreach($instrumenChart as $item)
                "{{ $item->nama_instrumen }}",
            @endforeach
        ]
    };

    new ApexCharts(
        document.querySelector("#pieChart"),
        pieOptions
    ).render();

    /*
    |--------------------------------------------------------------------------
    | PRODI CHART
    |--------------------------------------------------------------------------
    */

    var prodiOptions = {

        series: [{
            name: 'Kepuasan',
            data: [
                @foreach($chartProdi as $item)
                    {{ round($item->rata,2) }},
                @endforeach
            ]
        }],

        chart: {
            type: 'bar',
            height: 350
        },

        xaxis: {
            categories: [
                @foreach($chartProdi as $item)
                    "{{ $item->nama_prodi }}",
                @endforeach
            ]
        }
    };

    new ApexCharts(
        document.querySelector("#prodiChart"),
        prodiOptions
    ).render();

    /*
    |--------------------------------------------------------------------------
    | DOSEN CHART
    |--------------------------------------------------------------------------
    */

    var dosenOptions = {

        series: [{
            name: 'Kepuasan',
            data: [
                @foreach($chartDosen as $item)
                    {{ round($item->rata,2) }},
                @endforeach
            ]
        }],

        chart: {
            type: 'bar',
            height: 350
        },

        xaxis: {
            categories: [
                @foreach($chartDosen as $item)
                    "{{ $item->nama_dosen }}",
                @endforeach
            ]
        }
    };

    new ApexCharts(
        document.querySelector("#dosenChart"),
        dosenOptions
    ).render();

    </script>

    @endpush
@endsection
