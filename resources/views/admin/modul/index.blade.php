@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="card-title">{{ $subjudul }}</h4>
                    </div>
                    <div class="col-lg-6 text-end">
                        {!! $btn !!}
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive">

                <table class="table table-striped align-middle" id="datatable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Modul</th>
                            <th>Parent</th>
                            <th>URL</th>
                            <th>Icon</th>
                            <th>Aktif</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $no = 1; @endphp

                        @foreach($item as $row)
                        <tr>
                            <td>{{ $no++ }}</td>

                            {{-- Nama Modul + Hierarki --}}
                            <td>
                                @if($row->par)
                                    └── {{ $row->nama_modul }}
                                @else
                                    <strong>{{ $row->nama_modul }}</strong>
                                @endif
                            </td>

                            {{-- Parent --}}
                            <td>{{ $row->parent?->nama_modul ?? '-' }}</td>

                            {{-- URL --}}
                            <td>{{ $row->url ?? '-' }}</td>

                            {{-- Icon --}}
                            <td>
                                <i data-feather="{{ $row->icon ?? '-' }}"></i> {{ $row->icon }}
                            </td>

                            {{-- Aktif --}}
                            <td>
                                <a href="#"
                                   class="btn-publish-toggle"
                                   data-url="{{ $row->aktif ? route('modul.nonaktif', $row->uuid) : route('modul.aktif', $row->uuid) }}">

                                    <input type="checkbox"
                                        id="aktif{{ $row->uuid }}"
                                        switch="success"
                                        {{ $row->aktif ? 'checked' : '' }}>

                                    <label for="aktif{{ $row->uuid }}" data-on-label="Ya" data-off-label="Tidak"></label>
                                </a>
                            </td>

                            {{-- Aksi --}}
                            <td class="text-center">

                                <a href="{{ route('modul.edit', $row->uuid) }}"
                                   class="btn btn-link text-primary p-0 mx-1">
                                    <i class="far fa-edit fa-lg"></i>
                                </a>

                                <a href="#"
                                   class="btn btn-link text-danger p-0 mx-1 btn-delete"
                                   data-url="{{ route('modul.destroy', $row->uuid) }}">
                                    <i class="far fa-trash-alt fa-lg"></i>
                                </a>

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>

                {{-- FORM DELETE --}}
                <form id="form-delete" method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
