@extends('layouts.survey')
@section('title', 'Menu Survey')
@section('content')

<div class="survey-menu-container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Hero Section -->
            <div class="hero-section text-center mb-5 animate__animated animate__fadeInDown">
                <h1 class="hero-title mb-2">Dashboard Survey Kepuasan Mahasiswa</h1>
                <p class="hero-subtitle mb-3">
                    <i class="bi bi-calendar3"></i>
                    Semester {{ $periode['semester'] }} - Tahun Akademik {{ $periode['tahun_akademik'] }}
                </p>
                <p class="hero-description text-muted">Bantuan kami dalam meningkatkan kualitas pendidikan melalui feedback Anda</p>
            </div>

            <!-- Status Alerts -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show animate__animated animate__slideInDown" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show animate__animated animate__slideInDown" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <!-- User Profile Card -->
            <div class="user-profile-card mb-5 animate__animated animate__fadeInUp">
                <div class="profile-gradient-bg"></div>
                <div class="card border-0 shadow-lg">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="profile-avatar">
                                    <div class="avatar-badge">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="fw-bold mb-3">Profil Mahasiswa</h4>
                                        <div class="profile-info mb-3">
                                            <small class="text-muted d-block">NAMA</small>
                                            <p class="fw-semibold mb-0">{{ $mahasiswa->nama }}</p>
                                        </div>
                                        <div class="profile-info">
                                            <small class="text-muted d-block">NIM</small>
                                            <p class="fw-semibold mb-0">{{ $mahasiswa->nim }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="profile-info mb-3">
                                            <small class="text-muted d-block">PROGRAM STUDI</small>
                                            <p class="fw-semibold mb-0">{{ $mahasiswa->prodi->nama_prodi ?? '-' }}</p>
                                        </div>
                                        <div class="profile-info">
                                            <small class="text-muted d-block">JURUSAN</small>
                                            <p class="fw-semibold mb-0">{{ $mahasiswa->prodi->jurusan->nama_jurusan ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Survey Progress Section -->
            <div class="survey-progress-section mb-5 animate__animated animate__fadeInUp animate__delay-1s">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h5 class="fw-bold mb-1">
                                    <i class="bi bi-list-check text-primary"></i>
                                    Status Pengisian Survey
                                </h5>
                                <p class="text-muted small mb-3">Selesaikan semua survey untuk memberikan feedback terbaik</p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Survey Cards Grid -->
            <div class="survey-cards-grid">
                <div class="row g-4">
                    <!-- Card 1: Evaluasi Dosen -->
                    <div class="col-lg-4 animate__animated animate__fadeInUp animate__delay-2s">
                        <div class="survey-card survey-card-primary h-100">
                            <div class="card-icon-wrapper">
                                <i class="bi bi-person-video3"></i>
                            </div>
                            <div class="card-body p-4">
                                <div class="card-badge">
                                    <span class="badge bg-primary">{{ $instrumen1 ? '✓ Aktif' : 'Belum Dimulai' }}</span>
                                </div>
                                <h5 class="card-title fw-bold">Evaluasi Dosen</h5>
                                <p class="card-description">Penilaian kinerja dosen dan mata kuliah yang Anda ambil</p>
                                
                                <div class="card-info">
                                    <small class="badge bg-info bg-opacity-10 text-info">
                                        <i class="bi bi-info-circle"></i>
                                        Sesuai jumlah mata kuliah yang diambil
                                    </small>
                                </div>

                                <div class="card-action mt-4">
                                    <a href="{{ route('survey.instrumen', [$mahasiswa->uuid, 1]) }}" 
                                       class="btn btn-primary btn-survey w-100">
                                        <i class="bi bi-pencil-square"></i>
                                        Isi Survey
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Estimasi waktu: 5-10 menit</small>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Layanan Akademik -->
                    <div class="col-lg-4 animate__animated animate__fadeInUp animate__delay-3s">
                        <div class="survey-card survey-card-success h-100">
                            <div class="card-icon-wrapper">
                                <i class="bi bi-building"></i>
                            </div>
                            <div class="card-body p-4">
                                <div class="card-badge">
                                    @if($instrumen2)
                                        <span class="badge bg-success">✓ Selesai</span>
                                    @elseif(!$instrumen1)
                                        <span class="badge bg-secondary">Terkunci</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Siap Diisi</span>
                                    @endif
                                </div>
                                <h5 class="card-title fw-bold">Layanan Akademik</h5>
                                <p class="card-description">Evaluasi layanan administrasi dan akademik kampus</p>
                                
                                <div class="card-info">
                                    <small class="badge bg-success bg-opacity-10 text-success">
                                        <i class="bi bi-check-circle"></i>
                                        Diisi hanya satu kali
                                    </small>
                                </div>

                                <div class="card-action mt-4">
                                    @if(!$instrumen1)
                                        <button class="btn btn-secondary btn-survey w-100" disabled>
                                            <i class="bi bi-lock"></i>
                                            Terkunci
                                        </button>
                                        <small class="d-block mt-2 text-center text-muted">Selesaikan Evaluasi Dosen terlebih dahulu</small>
                                    @elseif($instrumen2)
                                        <button class="btn btn-success btn-survey w-100" disabled>
                                            <i class="bi bi-check-lg"></i>
                                            Sudah Diisi
                                        </button>
                                    @else
                                        <a href="{{ route('survey.instrumen', [$mahasiswa->uuid, 2]) }}" 
                                           class="btn btn-success btn-survey w-100">
                                            <i class="bi bi-pencil-square"></i>
                                            Isi Survey
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Estimasi waktu: 3-5 menit</small>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Fasilitas Kampus -->
                    <div class="col-lg-4 animate__animated animate__fadeInUp animate__delay-4s">
                        <div class="survey-card survey-card-warning h-100">
                            <div class="card-icon-wrapper">
                                <i class="bi bi-pc-display"></i>
                            </div>
                            <div class="card-body p-4">
                                <div class="card-badge">
                                    @if($instrumen3)
                                        <span class="badge bg-success">✓ Selesai</span>
                                    @elseif(!$instrumen2)
                                        <span class="badge bg-secondary">Terkunci</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Siap Diisi</span>
                                    @endif
                                </div>
                                <h5 class="card-title fw-bold">Fasilitas Kampus</h5>
                                <p class="card-description">Evaluasi sarana, prasarana, dan fasilitas kampus</p>
                                
                                <div class="card-info">
                                    <small class="badge bg-warning bg-opacity-10 text-warning">
                                        <i class="bi bi-info-circle"></i>
                                        Diisi hanya satu kali
                                    </small>
                                </div>

                                <div class="card-action mt-4">
                                    @if(!$instrumen2)
                                        <button class="btn btn-secondary btn-survey w-100" disabled>
                                            <i class="bi bi-lock"></i>
                                            Terkunci
                                        </button>
                                        <small class="d-block mt-2 text-center text-muted">Selesaikan Layanan Akademik terlebih dahulu</small>
                                    @elseif($instrumen3)
                                        <button class="btn btn-success btn-survey w-100" disabled>
                                            <i class="bi bi-check-lg"></i>
                                            Sudah Diisi
                                        </button>
                                    @else
                                        <a href="{{ route('survey.instrumen', [$mahasiswa->uuid, 3]) }}" 
                                           class="btn btn-warning btn-survey w-100">
                                            <i class="bi bi-pencil-square"></i>
                                            Isi Survey
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Estimasi waktu: 3-5 menit</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Section -->
            <div class="info-section mt-5 animate__animated animate__fadeInUp animate__delay-4s">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card border-0 bg-light">
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-3">
                                    <i class="bi bi-lightbulb text-warning"></i>
                                    Informasi Penting
                                </h6>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <i class="bi bi-check-circle text-success"></i>
                                        <small>Jawab semua pertanyaan dengan jujur untuk membantu kami meningkatkan kualitas pendidikan</small>
                                    </li>
                                    <li class="mb-2">
                                        <i class="bi bi-shield-check text-info"></i>
                                        <small>Data Anda dijaga kerahasiaannya dan hanya digunakan untuk keperluan evaluasi</small>
                                    </li>
                                    <li>
                                        <i class="bi bi-clock text-primary"></i>
                                        <small>Total waktu pengisian survey: ±15-20 menit</small>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .survey-menu-container {
        padding: 40px 0;
        min-height: 100vh;
    }

    /* Hero Section */
    .hero-section {
        margin-bottom: 3rem;
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #4e73df 0%, #6f42c1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1rem;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        font-weight: 500;
    }

    .hero-description {
        font-size: 1rem;
        line-height: 1.6;
    }

    /* User Profile Card */
    .user-profile-card {
        position: relative;
    }

    .profile-gradient-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 100px;
        background: linear-gradient(135deg, #4e73df 0%, #6f42c1 100%);
        border-radius: 15px 15px 0 0;
        z-index: 0;
    }

    .user-profile-card .card {
        position: relative;
        z-index: 1;
        border-radius: 15px;
        overflow: hidden;
    }

    .profile-avatar {
        position: relative;
        margin-top: -60px;
        margin-bottom: 1rem;
    }

    .avatar-badge {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4e73df 0%, #6f42c1 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
        box-shadow: 0 5px 20px rgba(78, 115, 223, 0.3);
        border: 4px solid white;
    }

    .profile-info {
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .profile-info small {
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .profile-info p {
        color: #212529;
        font-size: 1rem;
    }

    /* Survey Progress Section */
    .survey-progress-section {
        margin-bottom: 2rem;
    }

    .survey-progress-section .card {
        border-radius: 15px;
        background: linear-gradient(135deg, #f8f9ff 0%, #f0f2ff 100%);
    }

    .progress-container {
        background: white;
        padding: 1rem;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .progress {
        background-color: #e9ecef;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar-striped {
        background: linear-gradient(90deg, #4e73df 0%, #6f42c1 100%);
        background-size: 200% 200%;
        animation: gradientShift 3s ease infinite;
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .progress-stats {
        padding-top: 1rem;
    }

    .stat-item {
        background: white;
        padding: 1rem;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .stat-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .stat-label {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 0.5rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-weight: 600;
    }

    .stat-value {
        font-size: 1.5rem;
        margin: 0;
    }

    /* Circular Progress */
    .progress-circle-wrapper {
        padding: 1rem;
    }

    .circular-progress {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto;
    }

    .progress-ring {
        width: 100%;
        height: 100%;
        transform: rotate(-90deg);
    }

    .progress-ring circle {
        transition: stroke-dashoffset 0.5s ease;
    }

    .progress-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .progress-number {
        font-size: 1.75rem;
        font-weight: 700;
        background: linear-gradient(135deg, #4e73df 0%, #6f42c1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0;
    }

    .progress-label {
        font-size: 0.8rem;
        color: #6c757d;
        margin-top: 0.25rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Survey Cards Grid */
    .survey-cards-grid {
        margin: 2rem 0;
    }

    .survey-card {
        background: white;
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .survey-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, currentColor 0%, transparent 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .survey-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
    }

    .survey-card-primary::before {
        background: linear-gradient(90deg, #4e73df 0%, #6f42c1 100%);
    }

    .survey-card-success::before {
        background: linear-gradient(90deg, #28a745 0%, #20c997 100%);
    }

    .survey-card-warning::before {
        background: linear-gradient(90deg, #ffc107 0%, #fd7e14 100%);
    }

    .survey-card:hover::before {
        opacity: 1;
    }

    .card-icon-wrapper {
        width: 100%;
        padding: 2rem;
        text-align: center;
        font-size: 3rem;
        background: linear-gradient(135deg, rgba(78, 115, 223, 0.1) 0%, rgba(111, 66, 193, 0.1) 100%);
        margin-bottom: 1rem;
    }

    .survey-card-primary .card-icon-wrapper {
        color: #4e73df;
    }

    .survey-card-success .card-icon-wrapper {
        color: #28a745;
    }

    .survey-card-warning .card-icon-wrapper {
        color: #ffc107;
    }

    .card-badge {
        margin-bottom: 1rem;
    }

    .card-title {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
        color: #212529;
    }

    .card-description {
        color: #6c757d;
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 1rem;
    }

    .card-info {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .btn-survey {
        border-radius: 10px;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-survey:hover {
        transform: scale(1.02);
    }

    .btn-survey i {
        margin-right: 0.5rem;
    }

    .card-footer {
        padding: 1rem;
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
        margin-top: auto;
        text-align: center;
    }

    /* Info Section */
    .info-section .card {
        border-radius: 12px;
    }

    .info-section h6 {
        color: #212529;
        margin-bottom: 1rem;
    }

    .info-section li {
        padding-left: 0.5rem;
        line-height: 1.8;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 1.75rem;
        }

        .survey-card {
            margin-bottom: 1rem;
        }

        .profile-avatar {
            text-align: center;
        }

        .profile-info {
            margin-bottom: 1rem;
        }

        .circular-progress {
            width: 120px;
            height: 120px;
        }

        .progress-number {
            font-size: 1.5rem;
        }

        .stat-item {
            padding: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.7rem;
        }

        .stat-value {
            font-size: 1.25rem;
        }
    }

    /* Animation Delays */
    .animate__delay-1s { animation-delay: 0.1s; }
    .animate__delay-2s { animation-delay: 0.2s; }
    .animate__delay-3s { animation-delay: 0.3s; }
    .animate__delay-4s { animation-delay: 0.4s; }
</style>
@endsection
