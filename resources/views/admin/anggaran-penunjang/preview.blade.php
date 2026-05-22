@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Preview Import Anggaran Penunjang</h4>
    </div>

    <div class="card-body table-responsive">

        {{-- SUMMARY --}}
        @if($summary['error_rows'] > 0)
        <div class="alert alert-danger d-flex justify-content-between align-items-center">
            <div>
                ⚠ Ada {{ $summary['error_rows'] }} baris error
            </div>
            <button class="btn btn-warning btn-sm" onclick="scrollToError()">
                Lihat Error
            </button>
        </div>
        @endif

        <table class="table table-bordered table-sm align-middle table-striped" id="datatable">
            <thead>
            <tr class="table-light text-center">
                <th rowspan="2">No</th>
                <th rowspan="2">GIS</th>
                <th rowspan="2">Provinsi</th>
                <th rowspan="2">Kabupaten</th>
                <th rowspan="2">Status</th>
                <th rowspan="2">Tahun</th>
                <th rowspan="2">PIC</th>

                @foreach($groupedMapping as $kategori => $cols)
                    <th class="table-secondary text-center" colspan="{{ count($cols) }}">{{ $kategori }}</th>
                @endforeach
            </tr>

            <tr class="table-secondary text-center">
                @foreach($groupedMapping as $cols)
                    @foreach($cols as $col)
                        <th class="table-light text-center">{{ $col['nama'] }}</th>
                    @endforeach
                @endforeach
            </tr>
            </thead>

            <tbody>
            @foreach($data as $i => $row)
            <tr class="{{ !empty($row['error']) ? 'table-danger' : '' }}">

                <td>{{ $i+1 }}</td>
                <td>{{ $row['nilai'][1] ?? '' }}</td>

                <td class="{{ isset($row['error']['provinsi']) ? 'bg-danger text-white':'' }}">
                    {{ $row['nilai'][2] ?? '' }}
                </td>

                <td class="{{ isset($row['error']['kabupaten']) ? 'bg-danger text-white':'' }}">
                    {{ $row['nilai'][3] ?? ''}}
                </td>
                <td class="{{ isset($row['error']['status']) ? 'bg-danger text-white':'' }}">
                    {{ $row['nilai'][4] ?? '' }}
                </td>
                <td class="{{ isset($row['error']['tahun']) ? 'bg-danger text-white':'' }}">
                    {{ $row['nilai'][5] ?? ''}}
                </td>
                <td class="{{ isset($row['error']['pic']) ? 'bg-danger text-white' : '' }}">
                    {{ $row['nilai'][6] ?? ''}}
                </td>

                @foreach($mapping as $colIndex => $m)
                <td class="{{ isset($row['error'][$colIndex]) ? 'bg-danger text-white':'' }}">
                    {{ $row['nilai'][$colIndex] ?? '-' }}

                    @if(isset($row['error'][$colIndex]))
                        <div class="small">⚠ {{ $row['error'][$colIndex] }}</div>
                    @endif
                </td>
                @endforeach

            </tr>
            @endforeach
            </tbody>
        </table>

        {{-- 🔥 BUTTON IMPORT --}}
        @if($summary['error_rows'] > 0)
            <div class="alert alert-warning mt-3">
                ❌ Tidak bisa import, masih ada error
            </div>
        @else
            <form method="POST" action="{{ route('anggaran-penunjang.import-final') }}">
                @csrf
                <button class="btn btn-success">
                    Import Sekarang
                </button>
            </form>
        @endif

    </div>
</div>

@endsection


@push('scripts')
<script>

function scrollToError() {
    const el = document.querySelector('.row-error');

    if (el) {
        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
        el.style.outline = '3px solid orange';

        setTimeout(() => {
            el.style.outline = '';
        }, 2000);
    }
}

// 🔥 AUTO SCROLL SAAT LOAD
document.addEventListener('DOMContentLoaded', function () {
    scrollToError();
});

</script>
@endpush
