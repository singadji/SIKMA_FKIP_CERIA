@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h4 class="card-title mb-0">
                            {{ isset($item) ? 'Edit Anggaran Kegiatan Utama' : 'Anggaran Kegiatan Utama' }}
                        </h4>
                    </div>
                    <div class="col-lg-6 text-end">
                        {!! $btn ?? '' !!}
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ $aksi }}">
                @csrf
                @if(isset($item))
                    @method('PUT')
                @endif

                <div class="card-body">

                    {{-- TAHUN --}}
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $item->tahun ?? '') }}">
                    </div>

                    {{-- PROVINSI --}}
                    <div class="mb-3">
                        <label class="form-label">Provinsi</label>
                        <select name="provinsi_id" id="provinsi" class="form-control">
                            <option>-- Provinsi --</option>
                            @foreach($provinsi as $p)
                                <option value="{{ $p->id }}"
                                    {{ old('provinsi_id', $item->provinsi_id ?? '') == $p->id ? 'selected' : '' }}>
                                    {{ $p->provinsi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- KABUPATEN/KOTA --}}
                    <div class="mb-3">
                        <label class="form-label">Kabupaten/Kota</label>
                        <select name="kabupaten_id" id="kabupaten" class="form-control">
                            <option>-- Kabupaten/Kota --</option>
                        </select>
                    </div>

                    {{-- NAMA PIC --}}
                    <div class="mb-3">
                        <label class="form-label">Nama PIC</label>
                        <input type="text"
                            name="nama_pic"
                            class="form-control @error('nama_pic') is-invalid @enderror"
                            value="{{ old('nama_pic', $item->pic ?? '') }}"
                            placeholder="Contoh: Budi">

                        @error('nama_pic')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3"><hr></div>
                    <div class="mb-3">
                        <label class="form-label"><h4>Anggaran Kegiatan Utama</h4></label>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body table-responsive">
                                        <table class="table table-striped align-middle">

                                            <tbody>
                                                @php $no = 1; @endphp
                                                @foreach($subUrusan as $kategoriId => $rows)
                                                    @php
                                                        $kategori = optional($rows->first()->kategori);
                                                    @endphp
                                                    <tr class="table-primary">
                                                        <td colspan="4">
                                                            <strong>{{ $kategori->nama_kategori_urusan ?? '-' }}</strong>
                                                        </td>
                                                    </tr>
                                                    @foreach($rows as $row)
                                                        <tr>
                                                            <td>{{ $no++ }}</td>
                                                            <td></td>
                                                            <td>└── {{ $row->nama_sub_urusan }}</td>
                                                            <td class="text-center">
                                                               
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-left">
                    <button class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        {{ isset($item) ? 'Update' : 'Simpan' }}
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection

<script>
document.addEventListener("DOMContentLoaded", function () {

    const provinsi = document.getElementById('provinsi');
    const kabupaten = document.getElementById('kabupaten');

    // 👉 ambil kabupaten terpilih (untuk edit)
    const selectedKabupaten = "{{ old('kabupaten_id', $item->kabupaten_id ?? '') }}";

    function loadKabupaten(provinsiId, selected = null) {

        if (!provinsiId) {
            kabupaten.innerHTML = '<option value="">-- Kabupaten/Kota --</option>';
            return;
        }

        kabupaten.innerHTML = '<option>Loading...</option>';

        fetch("{{ url('wilayah/kabupaten') }}/" + provinsiId)
            .then(res => res.json())
            .then(data => {

                let html = '<option value="">-- Kabupaten/Kota --</option>';

                data.forEach(item => {
                    let isSelected = selected == item.id ? 'selected' : '';
                    html += `<option value="${item.id}" ${isSelected}>${item.kota_kabupaten}</option>`;
                });

                kabupaten.innerHTML = html;
            })
            .catch(err => {
                console.error(err);
                kabupaten.innerHTML = '<option>Error loading data</option>';
            });
    }

    // 👉 saat change
    provinsi.addEventListener('change', function () {
        loadKabupaten(this.value);
    });

    // 👉 🔥 AUTO LOAD SAAT EDIT
    if (provinsi.value) {
        loadKabupaten(provinsi.value, selectedKabupaten);
    }

});
</script>
