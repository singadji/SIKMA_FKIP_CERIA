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
                            <th>UUID</th>
                            <th>Kategori Unsur</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($item as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            {{-- Uuid --}}
                            <td>{{ $row->uuid }}</td>

                            {{-- Kategori Unsur --}}
                            <td>{{ $row->nama_kategori_unsur }}</td>

                            {{-- Aksi --}}
                            <td class="text-center">

                                <a href="{{ route('kategori-unsur.edit', $row->uuid) }}"
                                   class="btn btn-link text-primary p-0 mx-1">
                                    <i class="far fa-edit fa-lg"></i>
                                </a>

                                <a href="#"
                                   class="btn btn-link text-danger p-0 mx-1 btn-delete"
                                   data-url="{{ route('kategori-unsur.destroy', $row->uuid) }}">
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
