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
                            Daftar Instrumen Survey Kepuasan FKIP Universitas Pattimura
                        </small>
                    </div>
                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                        {!! $btn !!}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="datatable">
                        <thead class="table-light">
                            <tr>
                                <th width="60">#</th>
                                <th class="text-center">Kode Instrumen</th>
                                <th>Nama Instrumen</th>
                                <th>Deskripsi</th>
                                <th width="120" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item as $row)
                            <tr>
                                <td><span class="badge bg-light text-dark">{{ $loop->iteration }}</span></td>
                                <td><div class="fw-semibold">{{ $row->kode }}</div></td>
                                <td><div class="fw-semibold">{{ $row->nama_instrumen }}</div></td>
                                <td><span class="badge bg-light text-dark">{{ $row->deskripsi }}</span></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('instrument.edit', $row->uuid) }}"
                                            class="btn btn-sm btn-soft-primary"
                                            data-bs-toggle="tooltip"
                                            title="Edit"><i class="far fa-edit"></i></a>

                                        <button type="button"
                                            class="btn btn-sm btn-soft-danger btn-delete"
                                            data-url="{{ route('instrument.destroy', $row->uuid) }}"
                                            data-nama="{{ $row->nama_instrumen }}"
                                            data-bs-toggle="tooltip"
                                            title="Hapus"><i class="far fa-trash-alt"></i></button>
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
