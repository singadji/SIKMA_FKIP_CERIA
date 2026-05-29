@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-xl-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="text-muted">IKM Fakultas</h5>
                <h1 class="fw-bold text-primary">{{ $ikmFakultas }}</h1>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-xl-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0">
                <h5 class="card-title fw-bold mb-0">Distribusi Kepuasan Program Studi</h5>
            </div>
            <div class="card-body">
                <div id="donutProdi" style="min-height:420px;"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0">
                <h5 class="card-title fw-bold mb-0">Ranking Kepuasan Program Studi</h5>
            </div>
            <div class="card-body">
                <div id="chartFakultas" style="min-height:450px;"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h4 class="card-title fw-bold">{{ $subjudul }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class=" table table-bordered align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th class="text-start">Program Studi</th>
                                @foreach($instrumen as $item)
                                    <th>{{ $item }}</th>
                                @endforeach
                                <th width="150">Rerata Fakultas</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($pivot as $prodi => $nilai)
                            <tr>
                                <td class="fw-semibold">{{ $prodi }}</td>
                                @foreach($instrumen as $item)
                                @php
                                    $value = $nilai[$item] ?? 0;
                                    $class ='table-danger';
                                    if($value >= 3.5){
                                        $class = 'table-success';
                                    }elseif($value >= 2.5){
                                        $class = 'table-warning';
                                    }elseif($value >= 1.5){
                                        $class = 'table-info';
                                    }
                                @endphp
                                <td class="text-center fw-bold {{ $class }}">
                                    {{ number_format($value, 2) }}
                                </td>
                                @endforeach
                                <td class="text-center fw-bold bg-primary text-white">
                                    {{ number_format($nilai['RERATA_FAKULTAS'],2) }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>

document.addEventListener("DOMContentLoaded",function(){

        const donutOptions = {
            series: @json($prodiSeries),
            labels: @json($prodiLabels),
            chart: {
                type: "donut",
                height: 500,
                toolbar: {
                    show: true
                }
            },
            legend: {
                position: "bottom",
                fontSize: "13px"
            },

            dataLabels: {
                enabled: true,
                style: {
                    fontSize: "12px",
                    fontWeight: "bold",
                    colors: ["#ffffff"]
                },
                formatter:
                    function(val){
                    return (val.toFixed(1) + "%");
                }
            },

            plotOptions: {
                pie: {
                    donut: {
                        size: "50%",
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label:
                                    "IKM Fakultas",
                                formatter:
                                    function(){
                                    return "{{ $ikmFakultas }}";
                                }
                            }
                        }
                    }
                }
            },
            tooltip: {
                y: {
                    formatter:
                        function(val){
                        return (val.toFixed(2));
                    }
                }
            }
        };

        const donutChart =
            new ApexCharts(
                document.querySelector("#donutProdi"),
                donutOptions
            );
        donutChart.render();
    }
);
</script>
@endpush

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function(){
        const element = document.querySelector("#chartFakultas");

        if(!element){
            console.error("Element chartFakultas tidak ditemukan");
            return;
        }

        const options = {
            series: [{
                name: "Rerata Kepuasan",
                data: @json($chartSeries)
            }],
            chart: {
                type: "bar",
                height: 450,
                toolbar: {
                    show: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 8,
                    distributed: true,
                    barHeight: "100%"
                }
            },
            legend: {
                position: "bottom",
                fontSize: "13px",
                show: true
            },
            dataLabels: {
                enabled: true,
                style: {
                    colors: ["#ffffff"],
                    fontWeight: "bold"
                },
                formatter:
                    function(val){
                    return (val.toFixed(2));
                }
            },

            xaxis: {
                categories: @json($chartLabels),
                labels: {
                        show: false
                    },
                min: 0,
                max: 4
            },

            grid: {
                borderColor: "#f1f1f1"
            },

            tooltip: {
                y: {
                    formatter:
                        function(val){
                        return (val.toFixed(2));
                    }
                }
            }
        };

        const chart = new ApexCharts(element,options);
        chart.render();

    }
);

</script>

@endpush
