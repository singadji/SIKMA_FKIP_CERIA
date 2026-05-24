
@extends('layouts.app')

@section('title', 'Dashboard')
<style>
.apexcharts-datalabel-label,
.apexcharts-datalabel-value,
.apexcharts-data-labels text {
    fill: #ffffff !important;
}
</style>
@section('content')
<div class="row">
    {{-- TOTAL RESPONDEN --}}
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stats-wid bg-warning text-white">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <p class="text-white fw-medium">Total Responden</p>
                        <h1 class="mb-3 text-white text-center">
                            <span class="counter-value" data-target="{{ $totalResponden }}">0</span>
                        </h1>
                    </div>
                    <div class="col-2">
                        <i class="mdi mdi-48px mdi-account-group-outline text-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TOTAL MAHASISWA --}}
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stats-wid bg-success text-white">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <p class="text-white fw-medium">Jumlah Mahasiswa</p>
                        <h1 class="mb-3 text-center text-white">
                            <span class="counter-value" data-target="{{ $totalMahasiswa }}">0</span>
                        </h1>
                    </div>
                    <div class="col-2">
                        <i class="mdi mdi-48px mdi-school-outline text-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- TOTAL INSTRUMEN --}}
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stats-wid bg-info text-white">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <p class="text-white fw-medium">Jumlah Prodi</p>
                        <h1 class="mb-3 text-center text-white">
                            <span class="counter-value" data-target="{{ $totalProdi }}">0</span>
                        </h1>
                    </div>
                    <div class="col-2">
                        <i class="mdi mdi-48px mdi-account-box-multiple text-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- IKM --}}
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stats-wid bg-danger text-white">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <p class="text-white fw-medium">
                            Indeks Kepuasan
                        </p>
                        <h1 class="mb-3 text-center text-white">
                            <span class="counter-value" data-target="{{ $ikm }}">0</span>%
                        </h1>
                    </div>
                    <div class="col-2">
                        <i class="mdi mdi-48px mdi-chart-line text-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-2">
                 <i class="mdi mdi-chart-bar text-primary font-size-24"></i>Indeks Kepuasan Prodi
                </h4>
                <div id="chartKepuasanProdi" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-2">
                 <i class="mdi mdi-chart-pie text-primary font-size-24"></i>Distribusi Kepuasan per Instrumen
                </h4>
                <div id="instrumenPie" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <!--end card-->
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-2">
                 <i class="mdi mdi-grease-pencil text-primary font-size-24"></i>Data Survey Session Terbaru
                 </h4>
                 <p class="card-text">
                     Jumlah Survey Session: <span class="badge bg-primary">{{ $surveySessions->count() }}</span>
                 </p>
                 <table class="table table-striped table-hover" id="datatable">
                     <thead>
                         <tr>
                             <th>ID</th>
                             <th>Tanggal</th>
                             <th>Instrumen</th>
                             <th>Prodi</th>
                         </tr>
                     </thead>
                     <tbody>
                         @foreach ($latestSurvey as $session)
                             <tr>
                                 <td>{{ $session->uuid }}</td>
                                 <td>{{ $session->tanggal }}</td>
                                 <td>{{ $session->instrumen }}</td>
                                 <td>{{ $session->mahasiswa->prodi->nama_prodi }}</td>
                             </tr>
                         @endforeach
                     </tbody>
                 </table>
            </div>
        </div>
        <!--end card-->
    </div>
</div>

@endsection
<script>
    window.kepuasanPerProdi = @json(
        $kepuasanPerProdi
    );

    window.pieLabels = @json(
        $pieLabels
    );

    window.pieSeries = @json(
        $pieSeries
    );

</script>
<script src="{{ asset('assets/js/pages/grafikSurvey.js') }}"></script>
