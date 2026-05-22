@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$subjudul}}</h4>
                </div>
                <!-- end card header -->
            <form role="form" method="POST" action="{{ $aksi }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Nama Aplikasi / Instansi</label>
                                <input class="form-control" placeholder="Nama Aplikasi" type="text" name="nama_website" value="{{ $item->nama_website }}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Alamat Website (URL)</label>
                                <input class="form-control" placeholder="URL" type="url" name="url" value="{{ $item->url }}">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input class="form-control" placeholder="Email address" type="email" name="email" value="{{ $item->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Alamat instansi</label>
                                <input class="form-control" placeholder="Alamat Perusahaan" type="text" name="alamat" value="{{ $item->alamat }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">No. Telepon</label>
                                <input class="form-control" placeholder="" type="text" name="telepon" value="{{ $item->no_telp }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Facebook</label>
                                <input class="form-control" placeholder="" type="text" name="facebook" value="{{ $item->facebook }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Instagram</label>
                                <input class="form-control" placeholder="https://instagram.com/username atau @username" type="text" name="instagram" value="{{ $item->instagram }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label">Youtube</label>
                                <input class="form-control" placeholder="https://youtube.com/..." type="text" name="youtube" value="{{ $item->youtube }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Tag Line</label>
                                <input class="form-control" placeholder="Tag Line" type="text" name="tag_line" value="{{ $item->moto }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Keyword</label>
                                <input class="form-control" placeholder="" type="text" name="keyword" value="{{ $item->keyword }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-control-label">Logo</label>
                                <input type="file" name="logo"  class="form-control" accept="image/gif,image/jpeg,image/jpg,image/png">
                            </div>
                            <div class="col-sm-2">
                                <img src="{{ $item->logo }}" width="150">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-control-label">Favicon</label>
                                <input type="file" name="favicon"  class="form-control" accept="image/png">
                            </div>
                            <div class="col-sm-2">
                                <img src="{{ $item->favicon }}" width="32">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md"><i class="fa fa-save"></i> Submit</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
