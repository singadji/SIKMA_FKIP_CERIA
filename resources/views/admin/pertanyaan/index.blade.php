@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4 class="card-title mb-0 fw-bold">
                            {{ $subjudul }}
                        </h4>
                        <small class="text-muted">
                            Daftar Pertanyaan Survey Kepuasan Mahasiswa FKIP Universitas Pattimura
                        </small>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        {!! $btn !!}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="">
                        <thead class="table-light">
                            <tr>
                                <th width="60">#</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th width="120" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                        $currentInstrument = null;
                        @endphp
                        @foreach($item as $row)
                            @if($currentInstrument != $row->instrument->nama_instrumen)
                                @php
                                    $currentInstrument = $row->instrument->nama_instrumen;
                                @endphp
                                <tr class="table-primary">
                                    <td class="fw-bold text-uppercase"><i class="mdi mdi-folder-open-outline me-1"></i></td>
                                    <td>{{ $currentInstrument }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $row->nama_kategori }}</div>
                                </td>
                                <td>
                                    <div class="text-muted">{{ $row->deskripsi }}</div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('kategori-survey.edit', $row->uuid) }}"
                                            class="btn btn-sm btn-soft-primary"
                                            data-bs-toggle="tooltip"
                                            title="Edit">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-soft-danger btn-delete"
                                            data-url="{{ route('kategori-survey.destroy', $row->uuid) }}"
                                            data-nama="{{ $row->nama_kategori }}"
                                            data-bs-toggle="tooltip"
                                            title="Hapus">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <form id="form-delete" method="POST" style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
