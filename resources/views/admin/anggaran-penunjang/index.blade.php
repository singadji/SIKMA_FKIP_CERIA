@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="card-title">{{ $subjudul }}</h4>
                {!! $btn !!}
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode GIS</th>
                            <th>Provinsi</th>
                            <th>Kabupaten</th>
                            <th>PIC</th>
                            <th>Tahun Anggaran</th>
                            <th>Total Anggaran</th>
                            <th>Detail</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($data as $i => $row)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>{{ $row->kode_gis }}</td>
                            <td>{{ $row->provinsi->provinsi ?? '-' }}</td>
                            <td>{{ $row->kabupaten->kota_kabupaten ?? '-' }}</td>
                            <td>{{ $row->pic }}</td>
                            <td>{{ $row->periode_tahun }}</td>
                            <td>
                                <strong>
                                    Rp {{ number_format($row->total_anggaran ?? 0, 0, ',', '.') }}
                                </strong>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-info btn-detail"
                                        data-id="{{ $row->id }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDetail">
                                    Detail
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"> <span id="modalTitle"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div id="loading" class="text-center py-5">
                    <div class="spinner-border text-primary"></div>
                    <p class="mt-2">Memuat data...</p>
                </div>

                <div id="contentDetail" style="display:none;"></div>

            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).on('click', '.btn-detail', function () {

    let id = $(this).data('id');

    $('#loading').show();
    $('#contentDetail').hide();

    $.get(`{{ url('anggaran-penunjang') }}/${id}/detail`)
    .done(function (data) {

        console.log(data.anggaran[0]);

        let tahun = data.periode_tahun || '-';
        let provinsi = data.provinsi?.provinsi || '-';
        let kabupaten = data.kabupaten?.kota_kabupaten || '-';

        let title = document.getElementById('modalTitle');

        if (title) {
            title.innerHTML = `
                <div>Detail Anggaran RPJMD Tahun ${tahun}</div>
                <div class="text-muted small">${kabupaten} PROVINSI ${provinsi}</div>
            `;
        }

        let grouped = {};
        let grandTotal = 0;

        data.anggaran.forEach(function(item) {

            let kategori = null;

            // 🔥 ambil dari sub_kategori_unsur
            if (item.sub_kategori_unsur?.kategori?.nama_kategori_unsur) {
                kategori = item.sub_kategori_unsur.kategori.nama_kategori_unsur;
            }

            // 🔥 fallback dari kategori langsung
            else if (item.kategori_unsur?.nama_kategori_unsur) {
                kategori = item.kategori_unsur.nama_kategori_unsur;
            }

            if (!kategori) {
                kategori = 'Tidak Terklasifikasi';
            }

            if (!grouped[kategori]) {
                grouped[kategori] = [];
            }

            grouped[kategori].push(item);

            let val = parseFloat(item.nilai_rp);
            if (!isNaN(val)) {
                grandTotal += val;
            }
        });
        // =========================
        // 🔥 RENDER HTML
        // =========================
        let html = '';

        Object.keys(grouped).sort().forEach(function(kategori) {

            let subtotal = 0;

            html += `<h5 class="mt-4">${kategori}</h5>`;

            html += `
            <table class="table table-sm table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Sub Unsur</th>
                        <th class="text-end">Nilai</th>
                        <th class="text-end">%</th>
                    </tr>
                </thead>
                <tbody>
            `;

            grouped[kategori].forEach(function(item) {

                let nilai = parseFloat(item.nilai_rp);
                if (isNaN(nilai)) nilai = 0;

                subtotal += nilai;

                let persen = grandTotal > 0
                    ? ((nilai / grandTotal) * 100).toFixed(2)
                    : 0;

                // 🔥 FIX NAMA (sub atau kategori)
                let nama = '-';

                if (item.sub_kategori_unsur) {
                    nama = item.sub_kategori_unsur.nama_sub_unsur;
                } else if (item.kategori_unsur) {
                    nama = item.kategori_unsur.nama_kategori_unsur;
                }

                html += `
                    <tr>
                        <td>${nama}</td>
                        <td class="text-end">Rp ${nilai.toLocaleString('id-ID')}</td>
                        <td class="text-end">${persen} %</td>
                    </tr>
                `;
            });

            html += `
                <tr class="table-secondary">
                    <td><strong>Subtotal</strong></td>
                    <td class="text-end"><strong>Rp ${subtotal.toLocaleString('id-ID')}</strong></td>
                    <td></td>
                </tr>
            `;

            html += `</tbody></table>`;
        });

        // =========================
        // 🔥 TOTAL
        // =========================
        html += `
            <div class="mt-4 text-end">
                <h5>Total: Rp ${grandTotal.toLocaleString('id-ID')}</h5>
            </div>
        `;

        // =========================
        // 🔥 OUTPUT
        // =========================
        $('#contentDetail').html(html);
        $('#loading').hide();
        $('#contentDetail').fadeIn();

    })
    .fail(function (err) {
        console.error("ERROR:", err);
        $('#loading').html('<div class="text-danger">Gagal memuat data</div>');
    });

});
</script>
@endpush
