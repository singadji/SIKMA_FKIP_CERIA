<div class="card dashboard-card mb-4">
    <div class="card-body p-4">
        <div class="row g-3 align-items-end">
            <div class="col-lg-3">
                <label class="form-label fw-semibold">Tahun RPJMD</label>
                <select id="tahunFilter" class="form-select">
                    <option value="">Semua Tahun</option>
                        @foreach($tahunList as $tahun)
                            <option value="{{ $tahun }}" {{ $loop->first ? 'selected' : '' }}>{{ $tahun }}</option>
                        @endforeach
                </select>
            </div>
            <div class="col-lg-3">
                <label class="form-label fw-semibold">Provinsi</label>
                <select id="provinsiSelect" class="form-select">
                    <option value="">Semua Provinsi</option>
                        @foreach($provinsi as $item)
                            <option value="{{ $item->id }}">{{ $item->provinsi }}</option>
                        @endforeach
                </select>
            </div>
            <div class="col-lg-3">
                <label class="form-label fw-semibold">Kabupaten / Kota</label>
                <select id="kabupatenSelect" class="form-select">
                    <option value="">Semua Kabupaten/Kota</option>
                </select>
            </div>
            <div class="col-lg-3">
                <button id="filterButton" class="btn btn-primary w-100">Lihat</button>
            </div>
        </div>
    </div>
</div>
