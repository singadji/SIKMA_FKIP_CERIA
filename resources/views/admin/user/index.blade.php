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
                                <th class="text-uppercase text-center font-weight-bolder">No</th>
                                <th class="text-uppercase text-center font-weight-bolder">Nama</th>
                                <th class="text-uppercase text-center font-weight-bolder">e-Mail</th>
                                <th class="text-uppercase text-center font-weight-bolder">Role</th>
                                <th class="text-uppercase text-center font-weight-bolder">Aktif</th>
                                <th class="text-uppercase font-weight-bolder text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($item as $row)
                                <tr>
                                     <td class="align-middle text-left">{{ $no++ }}.</td>
                                        <td class="align-middle text-left">{{ $row->name }}</td>
                                        <td class="align-middle text-left">{{ $row->email }}</td>
                                        <td class="align-middle text-left">{{ $row->role }}</td>
                                    <td class="text-center">
                                <a href="#" 
                                    class="btn-publish-toggle" 
                                    data-url="{{ $row->aktif === 1 ? route('admin.manajemen-user.notpublish', $row->id) : route('admin.manajemen-user.publish', $row->id) }}">
                                    <input type="checkbox" id="switch{{ $row->id }}" switch="success" {{ $row->aktif === 1 ? 'checked' : '' }}>
                                    <label for="switch{{ $row->id }}" data-on-label="Ya" data-off-label="Tidak"></label>
                                </a>
                            </td>
                                    
                                    <td class="text-center">
                                        <a class="btn btn-link text-primary p-0 mx-1" href="{{ route('admin.manajemen-user.edit', $row->id) }}" title="Edit">
                                            <i class="far fa-edit fa-lg"></i>
                                        </a>
                                        <a href="#" class="btn btn-link text-danger p-0 mx-1 btn-delete"
                                            data-id="{{ $row->id }}"
                                            data-url="{{ route('admin.manajemen-user.destroy', $row->id) }}"
                                            title="Hapus">
                                            <i class="far fa-trash-alt fa-lg"></i>
                                        </a>
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
