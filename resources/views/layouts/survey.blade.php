<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title') | SIKMA FKIP CERIA
    </title>

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- Bootstrap Icons --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    {{-- Animate CSS --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />

    <style>

        body{

            background:
                linear-gradient(
                    135deg,
                    #f5f7ff,
                    #eef2ff
                );

            min-height:100vh;

            font-family:
                "Inter",
                sans-serif;
        }

        .survey-card{

            border:none;

            border-radius:25px;

            box-shadow:
                0 10px 40px rgba(0,0,0,0.08);
        }

        .btn-sikma{

            background:
                linear-gradient(
                    135deg,
                    #4e73df,
                    #6f42c1
                );

            border:none;

            color:white;

            border-radius:12px;

            padding:12px 24px;

            transition:0.3s;
        }

        .btn-sikma:hover{

            transform:translateY(-2px);

            color:white;

            opacity:0.95;
        }

        .form-control,
        .form-select{

            border-radius:12px;

            padding:12px;
        }

        .table{

            border-radius:15px;

            overflow:hidden;
        }

        .progress{

            border-radius:20px;
        }

        .progress-bar{

            background:
                linear-gradient(
                    135deg,
                    #4e73df,
                    #6f42c1
                );
        }

    </style>

    @stack('styles')

</head>

<body>

<div class="container py-5">

    @yield('content')

</div>

{{-- Bootstrap JS --}}
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

@stack('scripts')

</body>
</html>
