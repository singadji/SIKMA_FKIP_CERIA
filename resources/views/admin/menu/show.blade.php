@extends('layouts.admin')

@section('content')
<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title">{{ $subjudul }}</h4>
                        <p class="text-muted mb-0">Detail informasi menu yang dipilih.</p>
                    </div>
                    {!! $btn !!}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th width="25%">Nama Menu</th>
                                    <td>{{ $item->nama_menu }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{ $item->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Parent</th>
                                    <td>{{ $item->parent->nama_menu ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Link</th>
                                    <td>{{ $item->link_menu }}</td>
                                </tr>
                                <tr>
                                    <th>Posisi</th>
                                    <td>{{ $item->posisi }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge {{ $item->publish === 'Y' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $item->publish === 'Y' ? 'Publish' : 'Draft' }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @if(!empty($item->gambar))
                        <div class="mt-4">
                            <h5>Gambar</h5>
                            <img src="{{ asset('images/menu/' . $item->gambar) }}" alt="{{ $item->nama_menu }}" class="img-fluid rounded border" style="max-width: 320px;">
                        </div>
                    @endif

                    @if(!empty($item->dokumen))
                        <div class="mt-4">
                            <h5>Dokumen</h5>
                            <a href="{{ asset('files/' . $item->dokumen) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="fa fa-file"></i> Unduh Dokumen
                            </a>
                        </div>
                    @endif

                    @if(!empty($item->video))
                        <div class="mt-4">
                            <h5>Video</h5>
                            <p class="mb-2">{{ $item->video }}</p>
                            <a href="{{ asset('videos/' . $item->video) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                <i class="fa fa-play"></i> Putar Video
                            </a>
                        </div>
                    @endif

                    @if(!empty($item->isi_menu))
                        <div class="mt-4">
                            <h5>Isi Menu</h5>
                            <div class="border rounded p-3">
                                {!! $item->isi_menu !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
