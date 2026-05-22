@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Preview Import</h4>
    </div>

    <div class="card-body table-responsive">

        {{-- SUMMARY --}}
        @if($summary['error_rows'] > 0)
        <div class="alert alert-danger">
            ⚠ Ada {{ $summary['error_rows'] }} baris error
            <button class="btn btn-warning btn-sm" onclick="scrollToError()">
                Lihat Error
            </button>
        </div>
        @endif

        <table class="table table-bordered table-sm align-middle" id="datatable">
            <thead>

            <tr class="table-dark text-center">
                <th rowspan="2">No</th>
                <th rowspan="2">GIS</th>
                <th rowspan="2">Provinsi</th>
                <th rowspan="2">Kabupaten</th>
                <th rowspan="2">Status</th>
                <th rowspan="2">Tahun</th>
                <th rowspan="2">PIC</th>

                @foreach($groupedMapping as $kategori => $items)
                    <th colspan="{{ count($items) }}">
                        {{ $kategori }}
                    </th>
                @endforeach
            </tr>

            <tr class="table-secondary text-center">
                @foreach($groupedMapping as $items)
                    @foreach($items as $m)
                        <th>{{ $m['nama'] }}</th>
                    @endforeach
                @endforeach
            </tr>

            </thead>

            <tbody>
            @foreach($data as $row)
            <tr class="{{ !empty($row['error']) ? 'table-danger' : '' }}">

                <td>{{ $loop->iteration }}</td>
                <td>{{ $row['nilai'][1] ?? '-' }}</td>

                <td class="{{ isset($row['error']['provinsi']) ? 'bg-danger text-white' : '' }}">
                    {{ $row['nilai'][2] ?? '-' }}
                </td>

                <td class="{{ isset($row['error']['kabupaten']) ? 'bg-danger text-white' : '' }}">
                    {{ $row['nilai'][3] ?? '-' }}
                </td>

                <td class="{{ isset($row['error']['status']) ? 'bg-danger text-white' : '' }}">
                    {{ $row['nilai'][4] ?? '-' }}
                </td>
                <td class="{{ isset($row['error']['tahun']) ? 'bg-danger text-white' : '' }}">
                    {{ $row['nilai'][5] ?? '-' }}
                </td>
                <td class="{{ isset($row['error']['pic']) ? 'bg-danger text-white' : '' }}">
                    {{ $row['nilai'][6] ?? '-' }}
                </td>

                @foreach($groupedMapping as $items)
                    @foreach($items as $colIndex => $m)

                        <td class="{{ isset($row['error'][$colIndex]) ? 'bg-danger text-white' : '' }}">
                            {{ $row['nilai'][$colIndex] ?? '-' }}

                            @if(isset($row['error'][$colIndex]))
                                <div class="small">⚠ {{ $row['error'][$colIndex] }}</div>
                            @endif
                        </td>

                    @endforeach
                @endforeach

            </tr>
            @endforeach
            </tbody>
        </table>

        {{-- BUTTON IMPORT --}}
        @if($summary['error_rows'] > 0)
            <div class="alert alert-warning mt-3">
                ❌ Tidak bisa import, masih ada error
            </div>
        @else
            <form method="POST" action="{{ route('anggaran-utama.import-final') }}">
                @csrf
                <button class="btn btn-success mt-3">
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

document.addEventListener('DOMContentLoaded', function () {
    scrollToError();
});
</script>
@endpush
