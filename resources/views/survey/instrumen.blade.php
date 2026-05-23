@extends('layouts.survey')

<div class="container mt-4">
    <div class="mb-4">
        <h2 class="fw-bold">
            {{ $instrument->nama_instrumen }}
        </h2>
        <p class="text-muted">
            Berikan penilaian Anda secara objektif sesuai pengalaman Anda.
        </p>
    </div>
    <div class="card animate__animated animate__fadeInUp border-0 shadow-lg rounded-4">
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif
        <div class="card-body">
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <span>Progress Pengisian</span>
                        <span id="progressText">0%</span>
                    </div>
                    <div class="progress mt-2">
                        <div id="progressBar" class="progress-bar" style="width:0%"></div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">
                        {{ $instrument->nama_instrumen }}
                    </h2>
                    <p class="text-muted mb-0">
                        Silakan isi survey dengan objektif.
                    </p>
                </div>
                <div>
                    @if($instrument->id == 1)
                        <span class="badge bg-primary fs-6">
                            Evaluasi Dosen
                        </span>
                    @elseif($instrument->id == 2)
                        <span class="badge bg-success fs-6">
                            Layanan Akademik
                        </span>
                    @else
                        <span class="badge bg-warning fs-6">
                            Fasilitas Kampus
                        </span>
                    @endif
                </div>
            </div>
            <form id="formSurvey" method="POST" action="{{ route('survey.store-jawaban') }}" autocomplete="off">
                @csrf
                <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->id }}">
                <input type="hidden" name="instrument_id" value="{{ $instrument->id }}">

                {{-- KHUSUS INSTRUMEN 1 --}}
                @if($instrument->id == 1)

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label>Mata Kuliah</label>
                        <input type="text" name="mata_kuliah" value="" class="form-control" required placeholder="Masukkan nama mata kuliah">
                    </div>

                    <div class="col-md-6">
                        <label>Dosen</label>
                        <input type="text" name="dosen" value="" class="form-control" required placeholder="Masukkan nama dosen">
                    </div>
                </div>

                @endif

                @foreach($instrument->categories as $category)

                    <div class="mt-4">
                        <h4>{{ $category->nama_kategori }}</h4>
                        <p class="text-muted">{{ $category->deskripsi }}</p>
                    </div>
                    <table class="table align-middle table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th width="50%">Pernyataan</th>
                                <th class="text-center">STP</th>
                                <th class="text-center">TP</th>
                                <th class="text-center">P</th>
                                <th class="text-center">SP</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($category->questions as $question)
                            <tr class="question-group">
                                <td>{{ $question->pertanyaan }}</td>
                                @for($i = 1; $i <= 4; $i++)
                                <td class="text-center">
                                    <div class="form-check d-flex justify-content-center">
                                        <input
                                            type="radio"
                                            class="form-check-input question-radio"
                                            name="jawaban[{{ $question->id }}]"
                                            value="{{ $i }}"

                                            @checked(
                                                old('jawaban.'.$question->id) == $i
                                            )
                                        >
                                    </div>
                                </td>
                                @endfor
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endforeach
                <button type="button" id="btnSubmitSurvey" class="btn btn-md btn-sikma rounded-3 px-5">
                    <i class="bi bi-send"></i>
                    Simpan dan Lanjutkan
                </button>
            </form>
        </div>
    </div>
</div>

<script>

document.querySelector('form').addEventListener('submit', function(e) {
    let totalQuestions = [];
    document.querySelectorAll('.question-radio').forEach(function(el){
        let name = el.getAttribute('name');
        if (!totalQuestions.includes(name)) {
            totalQuestions.push(name);
        }
    });
    for (let i = 0; i < totalQuestions.length; i++) {
        let checked = document.querySelector(
            'input[name="' + totalQuestions[i] + '"]:checked'
        );
        if (!checked) {
            e.preventDefault();
            let target = document.querySelector(
                'input[name="' + totalQuestions[i] + '"]'
            );
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
            alert('Masih ada pertanyaan yang belum diisi.');
            return false;
        }
    }

});
</script>
<script>
    document.querySelectorAll('.question-radio').forEach(function(radio){
        radio.addEventListener('change', function(){
            localStorage.setItem(
                this.name,
                this.value
            );
        });
    });
</script>
<script>

document.querySelectorAll(
    '.question-radio'
).forEach(function(radio){

    radio.addEventListener('change', function(){

        localStorage.setItem(
            this.name,
            this.value
        );

    });

});

</script>
<script>

function updateProgress()
{
    let total = document.querySelectorAll(
        '.question-group'
    ).length;

    let checked = document.querySelectorAll(
        '.question-radio:checked'
    ).length;

    /*
    |--------------------------------------------------------------------------
    | ANTISIPASI DIVIDE BY ZERO
    |--------------------------------------------------------------------------
    */

    if (total === 0) {

        document.getElementById(
            'progressBar'
        ).style.width = '0%';

        document.getElementById(
            'progressText'
        ).innerHTML = '0%';

        return;
    }

    let percent = Math.round(
        (checked / total) * 100
    );

    document.getElementById(
        'progressBar'
    ).style.width = percent + '%';

    document.getElementById(
        'progressText'
    ).innerHTML = percent + '%';
}

document.querySelectorAll(
    '.question-radio'
).forEach(function(el){

    el.addEventListener(
        'change',
        updateProgress
    );

});

updateProgress();
</script>
@push('scripts')

<script>
document.addEventListener(
    'DOMContentLoaded',
    function(){
        const btn = document.getElementById(
            'btnSubmitSurvey'
        );
        btn.addEventListener(
            'click',
            function(){
                Swal.fire({
                    title: 'Kirim Survey?',
                    text: 'Pastikan semua jawaban sudah benar.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#4e73df',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Kirim',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Menyimpan...',
                            text: 'Mohon tunggu',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        document.getElementById(
                            'formSurvey'
                        ).submit();
                    }
                });
            }
        );
    }
);
</script>
@endpush
