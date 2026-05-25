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
                            Daftar Mahasiswa FKIP Universitas Pattimura
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
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Prodi</th>
                                <th>Status Aktif</th>
                                <th width="120" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item as $row)
                            <tr>
                                <td><span class="badge bg-light text-dark">{{ $loop->iteration }}</span></td>
                                <td>{{ $row->nim }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->prodi->nama_prodi }}</td>
                                <td><span class="badge rounded-pill bg-success-subtle text-success">{{ $row->status_aktif ? 'Aktif' : 'Tidak Aktif' }}</span></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('mahasiswa.edit', $row->uuid) }}"
                                            class="btn btn-sm btn-soft-primary"
                                            data-bs-toggle="tooltip"
                                            title="Edit"><i class="far fa-edit"></i></a>

                                        <button type="button"
                                            class="btn btn-sm btn-soft-danger btn-delete"
                                            data-url="{{ route('mahasiswa.destroy', $row->uuid) }}"
                                            data-nama="{{ $row->nama_mahasiswa }}"
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
