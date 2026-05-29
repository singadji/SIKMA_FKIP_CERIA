@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h4 class="card-title fw-bold">
                    {{ $subjudul }}
                </h4>
                <small class="text-muted">
                    Rerata indikator survey kepuasan mahasiswa per program studi
                </small>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light text-center">
                            <tr>
                                <th class="text-start">Program Studi</th>
                                @foreach($categories as $category)
                                    <th>{{ $category }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pivot as $prodi => $nilai)
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
                                        $class = 'table-info';
                                    }
                                    @endphp
                                    <td class="text-center fw-bold {{ $class }}">
                                        {{ number_format($value, 2) }}
                                    </td>
                                @endforeach
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
