<!DOCTYPE html>
<html>
<head>

    <title>{{ $instrument->nama_instrumen }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
</head>

<body class="bg-light">

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
            <h3>
                {{ $instrument->nama_instrumen }}
            </h3>

            <hr>

                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <strong>Progress Survey</strong>
                        </div>
                        <div>
                            {{ $progress }}%
                        </div>
                    </div>
                    <div class="progress rounded-pill mb-4" style="height: 22px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: {{ $progress }}%; background: linear-gradient(90deg,#4e73df,#6f42c1);">
                        </div>
                    </div>
                </div>
                {{-- WIZARD STEP --}}

                <div class="row text-center mb-5">

                    <div class="col">

                        <div class="
                            p-3
                            rounded-4
                            shadow-sm
                            {{ $instrument->id >= 1 ? 'bg-primary text-white' : 'bg-light' }}
                        ">
                            Instrumen 1
                        </div>

                    </div>

                    <div class="col">

                        <div class="
                            p-3
                            rounded-4
                            shadow-sm
                            {{ $instrument->id >= 2 ? 'bg-primary text-white' : 'bg-light' }}
                        ">
                            Instrumen 2
                        </div>

                    </div>

                    <div class="col">

                        <div class="
                            p-3
                            rounded-4
                            shadow-sm
                            {{ $instrument->id >= 3 ? 'bg-primary text-white' : 'bg-light' }}
                        ">
                            Instrumen 3
                        </div>

                    </div>

                </div>


            <form method="POST" action="{{ route('survey.store-jawaban') }}">
                @csrf
                <input type="hidden" name="session_id" value="{{ $session->id }}">

                <input
                    type="hidden"
                    name="instrument_id"
                    value="{{ $instrument->id }}"
                >

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
                            <tr>
                                <td>{{ $question->pertanyaan }}</td>
                                @for($i = 1; $i <= 4; $i++)
                                <td class="text-center">
                                    <div class="form-check d-flex justify-content-center">
                                        <input
                                            type="radio"
                                            class="form-check-input question-radio"
                                            name="jawaban[{{ $question->id }}]"
                                            value="{{ $i }}"
                                            required>
                                    </div>
                                </td>
                                @endfor
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endforeach
                <button class="btn btn-lg btn-primary rounded-3 px-5" onclick="return confirm('Apakah Anda yakin ingin melanjutkan?')">
                    Simpan & Lanjut
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
    window.onload = function() {
        document.querySelectorAll('.question-radio').forEach(function(radio){
            let saved = localStorage.getItem(radio.name);
            if (saved == radio.value) {
                radio.checked = true;
            }
        });
    };
</script>
</body>
</html>
