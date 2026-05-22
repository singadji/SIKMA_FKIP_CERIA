<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        SIKMA FKIP CERIA
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>

        body{
            background:
                linear-gradient(
                    135deg,
                    #4e73df,
                    #6f42c1
                );

            min-height:100vh;
        }

        .survey-card{

            border:none;

            border-radius:25px;

            overflow:hidden;

            backdrop-filter: blur(10px);

            box-shadow:
                0 10px 40px rgba(0,0,0,0.2);
        }

        .left-panel{

            background:
                linear-gradient(
                    180deg,
                    rgba(255,255,255,0.15),
                    rgba(255,255,255,0.05)
                );

            color:white;

            padding:60px 40px;
        }

        .right-panel{
            padding:60px 40px;
            background:white;
        }

        .logo-circle{

            width:100px;
            height:100px;

            border-radius:50%;

            background:white;

            display:flex;

            align-items:center;

            justify-content:center;

            margin:auto;

            font-size:40px;

            color:#4e73df;
        }

        .btn-sikma{

            background:#4e73df;
            border:none;

            border-radius:12px;

            padding:12px;
        }

        .btn-sikma:hover{
            background:#3656c9;
        }

        .form-control{
            border-radius:12px;
            padding:12px;
        }

    </style>

</head>

<body>

<div class="container">

    <div class="row justify-content-center align-items-center vh-100">

        <div class="col-lg-10">

            <div class="card survey-card">

                <div class="row g-0">

                    {{-- LEFT --}}
                    <div class="col-lg-5">

                        <div class="left-panel h-100 d-flex flex-column justify-content-center">

                            <div class="text-center">

                                <div class="mb-4">
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="img-fluid">
                                </div>
                            </div>

                        </div>

                    </div>

                    {{-- RIGHT --}}
                    <div class="col-lg-7">

                        <div class="right-panel">

                            <h3 class="fw-bold mb-2">
                                Selamat Datang 👋
                            </h3>

                            <p class="text-muted mb-4">

                                Silakan masukkan NIM untuk memulai survey kepuasan mahasiswa.

                            </p>

                            @if(session('error'))

                                <div class="alert alert-danger">

                                    {{ session('error') }}

                                </div>

                            @endif

                            <form method="POST" action="{{ route('survey.cek-nim') }}">

                                @csrf

                                <div class="mb-4">

                                    <label class="form-label fw-semibold">

                                        Nomor Induk Mahasiswa

                                    </label>

                                    <input
                                        type="text"
                                        name="nim"
                                        class="form-control"
                                        placeholder="Masukkan NIM"
                                        required
                                    >

                                </div>

                                <button
                                    class="btn btn-sikma text-white w-100"
                                >

                                    <i class="bi bi-arrow-right-circle me-2"></i>

                                    Mulai Survey

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>
