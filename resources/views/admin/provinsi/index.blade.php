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
                            <th>Kode Provinsi</th>
                            <th>Provinsi</th>
                            <th>Peta</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($item as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->provinsi }}</td>
                            <td>
                                <img
                                    src="{{ asset($row->thumbnail) }}"
                                    width="70%"
                                    height="70%"
                                    class="img-fluid"
                                />
                            </td>
                            <td class="text-center">

                                <a href="{{ route('master-provinsi.edit', $row->id) }}"
                                   class="btn btn-link text-primary p-0 mx-1">
                                    <i class="far fa-edit fa-lg"></i>
                                </a>
                                <a href="#"
                                   class="btn btn-link text-danger p-0 mx-1 btn-delete"
                                   data-url="{{ route('master-provinsi.destroy', $row->id) }}">
                                    <i class="far fa-trash-alt fa-lg"></i>
                                </a>

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
@endsection
