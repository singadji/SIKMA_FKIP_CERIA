@extends('layouts.admin')

@section('content')

        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="card-title">{{ $subjudul }}</h4>
                        <p class="card-title-desc"></p>
                    </div>
                    <div class="col-lg-6 text-end">
                        {!! $btn !!}
                    </div>
                </div>
            </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="datatable" class="table table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="text-uppercase font-weight-bolder text-center">#</th>
                                <th class="text-uppercase font-weight-bolder text-center">Menu</th>
                                <th class="text-uppercase font-weight-bolder text-center">Parent</th>
                                <th class="text-uppercase font-weight-bolder text-center">Position</th>
                                <th class="text-uppercase font-weight-bolder text-center">Link</th>
                                <th class="text-uppercase font-weight-bolder text-center">Publish</th>
                                <th class="text-uppercase font-weight-bolder text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($item as $row)
                                <tr>
                                    <td class="align-middle text-left">{{$no++}}.</td>
                                    <td class="align-middle text-left">
                                        <div class="fw-semibold">{{ $row->nama_menu }}</div>
                                        <div class="text-muted small">{{ $row->slug }}</div>
                                    </td>
                                    <td class="align-middle text-center">{{ $row->parent->nama_menu ?? '-' }}</td>
                                    <td class="align-middle text-center">{{ $row->posisi}}</td>
                                    <td class="align-middle text-left">{{ $row->link_menu }}</td>
                                    <td class="text-center">
                                <a href="#"
                                    class="btn-publish-toggle"
                                    data-url="{{ $row->publish === 1 ? route('admin.menu.notpublish', $row->slug) : route('admin.menu.publish', $row->slug) }}">
                                    <input type="checkbox" id="switch{{ $row->id_menu }}" switch="success" {{ $row->publish === 1 ? 'checked' : '' }}>
                                    <label for="switch{{ $row->id_menu }}" data-on-label="Ya" data-off-label="Tidak"></label>
                                </a>
                            </td>

                                    <td class="text-center">
                                        @if(!$row->dipakai)
                                            <a class="btn btn-link text-primary p-0 mx-1" href="{{ route('admin.menu.edit', $row->slug) }}" title="Edit">
                                                <i class="far fa-edit fa-lg"></i>
                                            </a>
                                            <a href="#" class="btn btn-link text-danger p-0 mx-1 btn-delete"
                                                data-id="{{ $row->slug }}"
                                                data-url="{{ route('admin.menu.destroy', $row->slug) }}"
                                                title="Hapus">
                                                <i class="far fa-trash-alt fa-lg"></i>
                                            </a>
                                        @else
                                            <span class="text-muted">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <form id="form-delete" method="POST" style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
@endsection
