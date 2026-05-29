@extends('layouts.app')
@section('content')
@php
use Illuminate\Support\Str;
@endphp

<div class="row">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title fw-bold mb-1">{{ $subjudul }}</h4>
                        <small class="text-muted">Analytics indikator survey per Program Studi</small>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @foreach($analytics as $instrumen => $prodiData)
                @php
                    $categories = $kategoriPerInstrumen[$instrumen];
                    $chartLabels = [];
                    $chartSeries = [];

                    foreach($prodiData as $prodi => $nilai){
                        $chartLabels[] = $prodi;
                        $total = 0;
                        $jumlah = 0;
                        foreach($categories as $kategori){
                            if(isset($nilai[$kategori])){
                                $total += $nilai[$kategori];
                                $jumlah++;
                            }
                        }
                        $chartSeries[] = $jumlah > 0 ? round($total / $jumlah, 2) : 0;
                    }

                    $chartId = 'chart_' . Str::slug($instrumen);
                @endphp

                <div class="card border mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 fw-bold text-white">{{ $instrumen }}</h5>
                    </div>
                    <div class="card-body">
                        <div id="{{ $chartId }}" class="mb-4"></div>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th class="text-start">Program Studi</th>
                                        @foreach($categories as $category)
                                            <th> {{ $category }}</th>
                                        @endforeach
                                        <th width="120">Rerata</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prodiData as $prodi => $nilai)
                                    @php
                                        $total = 0;
                                        $jumlah = 0;
                                    @endphp
                                    <tr>
                                        <td class="fw-semibold">{{ $prodi }}</td>
                                        @foreach($categories as $category)
                                            @php
                                                $value = $nilai[$category] ?? 0;
                                                $class = 'table-danger';
                                                if($value >= 3.5){
                                                    $class = 'table-success';
                                                }elseif($value >= 2.5){
                                                    $class = 'table-warning';
                                                }elseif($value >= 1.5){
                                                    $class ='table-info';
                                                }

                                                if($value > 0){
                                                    $total += $value;
                                                    $jumlah++;
                                                }
                                            @endphp
                                            <td class="text-center fw-bold {{ $class }}">
                                                {{ number_format($value, 2) }}
                                            </td>
                                        @endforeach

                                        @php
                                            $rerata = $jumlah > 0 ? round($total / $jumlah, 2) : 0;
                                        @endphp
                                        <td class="text-center fw-bold bg-primary text-white">{{ $rerata }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @push('scripts')
                <script>
                document.addEventListener("DOMContentLoaded", function(){
                        const options = {
                            series: [{
                                name: "Rerata Kepuasan",
                                data: @json($chartSeries)
                            }],
                            chart: {
                                type: "bar",
                                height: 350,
                                toolbar: {
                                    show: true
                                }
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                    borderRadius: 6,
                                    distributed: true,
                                    barHeight: "70%"
                                }
                            },
                            colors: [
                                function({
                                    value
                                }){
                                    if(value >= 3.5){return "#1cc88a";}
                                    if(value >= 2.5){return "#f6c23e";}
                                    if(value >= 1.5){return "#36b9cc";}

                                    return "#e74a3b";
                                }
                            ],
                            dataLabels: {
                                enabled: true,
                                style: {
                                    colors: ["#000000"],
                                    fontWeight: "bold"
                                },
                                formatter:
                                    function(val){
                                    return val.toFixed(2);
                                }
                            },
                            xaxis: {
                                categories: @json($chartLabels),
                                min: 0,
                                max: 4
                            },
                            legend: {
                                show: false
                            }
                        };
                        const chart = new ApexCharts(document.querySelector("#{{ $chartId }}"), options);
                        chart.render();
                    }
                );
                </script>
                @endpush
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
