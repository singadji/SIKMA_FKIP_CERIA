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

                <table class="table table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;">#</th>
                            <th>Kategori Urusan</th>
                            <th>Sub Urusan</th>
                            <th class="text-center" style="width:120px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $no = 1; @endphp

                        @foreach($item as $kategoriId => $rows)

                            @php
                                $kategori = optional($rows->first()->kategori);
                            @endphp

                            {{-- HEADER KATEGORI --}}
                            <tr class="table-primary">
                                <td colspan="4">
                                    <strong>{{ $kategori->nama_kategori_urusan ?? '-' }}</strong>
                                </td>
                            </tr>

                            {{-- LIST SUB Urusan --}}
                            @foreach($rows as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>

                                    {{-- Kosongkan kolom kategori agar tidak berulang --}}
                                    <td></td>

                                    <td>└── {{ $row->nama_sub_urusan }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('sub-urusan.edit', $row->uuid) }}"
                                           class="btn btn-link text-primary p-0 mx-1">
                                            <i class="far fa-edit fa-lg"></i>
                                        </a>

                                        <a href="#"
                                           class="btn btn-link text-danger p-0 mx-1 btn-delete"
                                           data-url="{{ route('sub-urusan.destroy', $row->uuid) }}">
                                            <i class="far fa-trash-alt fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

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
