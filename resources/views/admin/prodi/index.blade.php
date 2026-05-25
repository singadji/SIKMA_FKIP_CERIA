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
                            Daftar Program Studi FKIP Universitas Pattimura
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
                                <th>Nama Prodi</th>
                                <th>Jurusan</th>
                                <th width="120" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($item as $row)
                            <tr>
                                <td><span class="badge bg-light text-dark">{{ $loop->iteration }}</span></td>
                                <td><div class="fw-semibold">{{ $row->nama_prodi }}</div></td>
                                <td>
                                @php
                                $badgeClass = 'bg-secondary-subtle text-secondary';
                                switch($row->jurusan->nama_jurusan){
                                    case 'Ilmu Pendidikan':
                                        $badgeClass =
                                            'bg-primary-subtle text-primary';
                                        break;
                                    case 'Bahasa dan Seni':
                                        $badgeClass =
                                            'bg-danger-subtle text-danger';
                                        break;
                                    case 'Ilmu Pengetahuan Sosial':
                                        $badgeClass =
                                            'bg-warning-subtle text-warning';
                                        break;
                                    case 'Matematika dan Ilmu Pengetahuan Alam':
                                        $badgeClass =
                                            'bg-success-subtle text-success';
                                        break;
                                }
                                @endphp
                                <span class="badge rounded-pill {{ $badgeClass }}">
                                    {{ $row->jurusan->nama_jurusan }}
                                </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('prodi.edit', $row->id) }}"
                                            class="btn btn-sm btn-soft-primary"
                                            data-bs-toggle="tooltip"
                                            title="Edit"><i class="far fa-edit"></i></a>

                                        <button type="button"
                                            class="btn btn-sm btn-soft-danger btn-delete"
                                            data-url="{{ route('prodi.destroy', $row->id) }}"
                                            data-nama="{{ $row->nama_prodi }}"
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
