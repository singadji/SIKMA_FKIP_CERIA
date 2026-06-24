@extends('layouts.survey')

@push('styles')
<style>
    :root {
        --primary-color: #4e73df;
        --light-bg: #f8f9fa;
        --hover-shadow: 0 4px 15px rgba(78, 115, 223, 0.15);
    }

    .radio-option {
        cursor: pointer;
        transition: all 0.3s ease;
        padding: 8px 12px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .radio-option:hover {
        background-color: #f0f0f0;
    }

    .question-radio:checked + .radio-option,
    .radio-option.active {
        background-color: var(--primary-color);
        color: white;
        font-weight: bold;
    }

    .question-group {
        transition: background-color 0.2s ease;
    }

    .question-group:hover {
        background-color: var(--light-bg);
    }

    .category-card {
        border-left: 4px solid var(--primary-color);
        transition: all 0.3s ease;
    }

    .category-card:hover {
        box-shadow: var(--hover-shadow);
    }

    @media (max-width: 768px) {
        .radio-option {
            padding: 6px 10px;
            font-size: 0.85rem;
        }

        th, td {
            padding: 8px 4px !important;
        }
    }
</style>
@endpush

<div class="container mt-4">
    <div class="mb-4">
        <h2 class="fw-bold">{{ $instrument->nama_instrumen }}</h2>
        <p class="text-muted">Berikan penilaian Anda secara objektif sesuai pengalaman Anda.</p>
    </div>

    <div class="card animate__animated animate__fadeInUp border-0 shadow-lg rounded-4">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card-body">
            <!-- Progress Section -->
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold">Progress Pengisian</span>
                        <span id="progressText" class="badge bg-primary">0%</span>
                    </div>
                    <div class="progress" style="height: 24px;">
                        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" style="width:0%"></div>
                    </div>
                </div>
            </div>

            <!-- Header Info -->
            <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
                <div class="flex-grow-1">
                    <h5 class="fw-bold mb-2">{{ $instrument->nama_instrumen }}</h5>
                    <p class="text-muted mb-2 small">Silakan isi survey dengan objektif dan jujur.</p>
                    <div class="alert alert-info py-2 px-3 mb-0 small">
                        <strong>Keterangan:</strong>
                        <span class="ms-1">
                            <span class="badge bg-danger">STP</span> Sangat Tidak Puas |
                            <span class="badge bg-warning text-dark">TP</span> Tidak Puas |
                            <span class="badge bg-info">P</span> Puas |
                            <span class="badge bg-success">SP</span> Sangat Puas
                        </span>
                    </div>
                </div>
                <div class="flex-shrink-0">
                    @if($instrument->id == 1)
                        <span class="badge bg-primary fs-6"><i class="bi bi-person-check"></i> Evaluasi Dosen</span>
                    @elseif($instrument->id == 2)
                        <span class="badge bg-success fs-6"><i class="bi bi-briefcase"></i> Layanan Akademik</span>
                    @else
                        <span class="badge bg-warning fs-6"><i class="bi bi-building"></i> Fasilitas Kampus</span>
                    @endif
                </div>
            </div>

            <form id="formSurvey" method="POST" action="{{ route('survey.store-jawaban') }}" autocomplete="off">
                @csrf
                <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->id }}">
                <input type="hidden" name="instrument_id" value="{{ $instrument->id }}">

                <!-- Instrumen 1: Mata Kuliah Input -->
                @if($instrument->id == 1)
                    <div class="alert alert-info mb-4">
                        <h6 class="alert-heading mb-2"><i class="bi bi-info-circle"></i> Informasi Penting</h6>
                        <small>Tuliskan nama mata kuliah yang Anda nilai. Ini membantu kami mengidentifikasi feedback untuk dosen yang tepat.</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold"><i class="bi bi-book"></i> Mata Kuliah <span class="text-danger">*</span></label>
                        <input type="text" name="mata_kuliah" value="{{ old('mata_kuliah') }}" 
                               class="form-control form-control-lg" required 
                               placeholder="Contoh: Pemrograman Web, Basis Data">
                        <small class="text-muted"><i class="bi bi-question-circle"></i> Pastikan sesuai dengan KRS Anda</small>
                    </div>

                    <input type="hidden" name="dosen" value="">
                @endif

                <!-- Survey Questions Accordion -->
                <div class="accordion" id="surveyAccordion">
                    @foreach($instrument->categories as $idx => $category)
                        <div class="accordion-item category-card">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $idx === 0 ? '' : 'collapsed' }}" 
                                        type="button" data-bs-toggle="collapse" data-bs-target="#category{{ $idx }}">
                                    <span class="fw-bold"><i class="bi bi-list-check"></i> {{ $category->nama_kategori }}</span>
                                    <span class="ms-auto badge bg-secondary category-badge-{{ $idx }}">
                                        <span class="category-filled-{{ $idx }}">0</span>/<span class="category-total-{{ $idx }}">{{ $category->questions->count() }}</span>
                                    </span>
                                </button>
                            </h2>
                            <div id="category{{ $idx }}" class="accordion-collapse collapse {{ $idx === 0 ? 'show' : '' }}" data-bs-parent="#surveyAccordion">
                                <div class="accordion-body p-0">
                                    <p class="text-muted px-4 pt-3 mb-3 small"><i class="bi bi-info-circle"></i> {{ $category->deskripsi }}</p>
                                    <div class="table-responsive">
                                        <table class="table align-middle table-hover mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="50%">Pernyataan</th>
                                                    <th class="text-center" width="12.5%">STP</th>
                                                    <th class="text-center" width="12.5%">TP</th>
                                                    <th class="text-center" width="12.5%">P</th>
                                                    <th class="text-center" width="12.5%">SP</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($category->questions as $question)
                                                    <tr class="question-group" data-question-id="{{ $question->id }}">
                                                        <td><small>{{ $question->pertanyaan }}</small></td>
                                                        @for($i = 1; $i <= 4; $i++)
                                                            <td class="text-center">
                                                                <div class="form-check d-flex justify-content-center">
                                                                    <input type="radio" class="form-check-input d-none question-radio category-{{ $idx }}"
                                                                           id="q{{ $question->id }}_{{ $i }}"
                                                                           name="jawaban[{{ $question->id }}]" value="{{ $i }}"
                                                                           data-category-idx="{{ $idx }}"
                                                                           @checked(old('jawaban.'.$question->id) == $i)>
                                                                    <label for="q{{ $question->id }}_{{ $i }}" class="radio-option {{ old('jawaban.'.$question->id) == $i ? 'active' : '' }}">
                                                                        @if($i == 1)
                                                                            <i class="bi bi-hand-thumbs-down"></i>
                                                                        @elseif($i == 2)
                                                                            <i class="bi bi-dash-circle"></i>
                                                                        @elseif($i == 3)
                                                                            <i class="bi bi-check-circle"></i>
                                                                        @else
                                                                            <i class="bi bi-hand-thumbs-up"></i>
                                                                        @endif
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        @endfor
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Action Buttons -->
                <div class="mt-5 d-flex gap-2">
                    <button type="button" id="btnViewSummary" class="btn btn-lg btn-outline-secondary rounded-3 flex-grow-1">
                        <i class="bi bi-eye"></i> Lihat Ringkasan
                    </button>
                    <button type="button" id="btnSubmitSurvey" class="btn btn-lg btn-sikma rounded-3 flex-grow-1">
                        <i class="bi bi-send"></i> Kirim Survey
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Summary -->
<div class="modal fade" id="summaryModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="bi bi-check2-square"></i> Ringkasan Jawaban Anda</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="summaryContent" style="max-height: 60vh; overflow-y: auto;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ubah Jawaban</button>
                <button type="button" id="btnConfirmSubmit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Konfirmasi & Kirim
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const RESPONSE_LABELS = {
        1: '🔴 Sangat Tidak Puas',
        2: '🟠 Tidak Puas',
        3: '🟢 Puas',
        4: '🟢 Sangat Puas'
    };

    const RESPONSE_COLORS = {
        1: 'danger',
        2: 'warning',
        3: 'info',
        4: 'success'
    };

    // Initialize on DOM ready
    document.addEventListener('DOMContentLoaded', function() {
        attachRadioChangeListeners();
        attachFormSubmitListener();
        attachButtonListeners();
        updateCategoryProgress();
    });

    // Attach change listeners to all radios
    function attachRadioChangeListeners() {
        document.querySelectorAll('.question-radio').forEach(radio => {
            radio.addEventListener('change', function() {
                localStorage.setItem(this.name, this.value);
                updateRadioLabel(this);
                updateCategoryProgress();
            });
        });
    }

    // Update visual label for selected radio
    function updateRadioLabel(radio) {
        const group = radio.closest('.question-group');
        group.querySelectorAll('.radio-option').forEach(label => label.classList.remove('active'));
        radio.nextElementSibling?.classList.add('active');
    }

    // Calculate overall progress
    function updateProgress() {
        const total = document.querySelectorAll('.question-group').length;
        const checked = document.querySelectorAll('.question-radio:checked').length;
        const percent = total > 0 ? Math.round((checked / total) * 100) : 0;
        
        document.getElementById('progressBar').style.width = percent + '%';
        document.getElementById('progressText').textContent = percent + '%';
    }

    // Calculate progress per category
    function updateCategoryProgress() {
        document.querySelectorAll('.accordion-item').forEach((category, idx) => {
            const questions = category.querySelectorAll(`.category-${idx}`);
            const checked = category.querySelectorAll(`.category-${idx}:checked`).length;
            
            document.querySelector(`.category-filled-${idx}`).textContent = checked;
            
            const badge = document.querySelector(`.category-badge-${idx}`);
            if (questions.length > 0) {
                if (checked === questions.length) {
                    badge.className = `category-badge-${idx} badge bg-success`;
                } else if (checked > 0) {
                    badge.className = `category-badge-${idx} badge bg-warning`;
                } else {
                    badge.className = `category-badge-${idx} badge bg-secondary`;
                }
            }
        });
        updateProgress();
    }

    // Attach form submit listener
    function attachFormSubmitListener() {
        document.getElementById('formSurvey').addEventListener('submit', function(e) {
            e.preventDefault();
            const unanswered = [];
            
            document.querySelectorAll('.question-group').forEach(group => {
                if (!group.querySelector('.question-radio:checked')) {
                    unanswered.push(group.querySelector('td:first-child').textContent.trim());
                }
            });
            
            if (unanswered.length > 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Pertanyaan Belum Dijawab',
                    text: 'Silakan jawab semua pertanyaan sebelum mengirim.',
                    confirmButtonColor: '#4e73df'
                });
                document.querySelector('.question-group').scrollIntoView({ behavior: 'smooth', block: 'center' });
                return false;
            }
            
            this.submit();
        });
    }

    // Attach button listeners
    function attachButtonListeners() {
        // View Summary Button
        document.getElementById('btnViewSummary').addEventListener('click', showSummary);

        // Submit Button
        document.getElementById('btnSubmitSurvey').addEventListener('click', function() {
            const total = document.querySelectorAll('.question-group').length;
            const checked = document.querySelectorAll('.question-radio:checked').length;
            
            if (checked < total) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Belum Lengkap',
                    text: `${checked} dari ${total} pertanyaan sudah dijawab.`,
                    confirmButtonColor: '#4e73df'
                });
                return;
            }
            
            showSummary();
        });

        // Confirm Submit Button
        document.getElementById('btnConfirmSubmit').addEventListener('click', confirmSubmit);
    }

    // Show summary modal
    function showSummary() {
        let html = '';
        
        document.querySelectorAll('.accordion-item').forEach(category => {
            const title = category.querySelector('.accordion-button').textContent
                .trim().replace(/\d+\/\d+/, '').trim();
            
            html += `<div class="mb-4"><h6 class="fw-bold text-primary"><i class="bi bi-folder"></i> ${title}</h6>`;
            
            category.querySelectorAll('.question-group').forEach(question => {
                const text = question.querySelector('td:first-child').textContent.trim();
                const radio = question.querySelector('.question-radio:checked');
                
                if (radio) {
                    const value = radio.value;
                    html += `<div class="mb-2"><small>${text}</small><br>
                             <span class="badge bg-${RESPONSE_COLORS[value]}">${RESPONSE_LABELS[value]}</span></div>`;
                } else {
                    html += `<div class="mb-2"><small>${text}</small><br>
                             <span class="badge bg-light text-dark"><i class="bi bi-exclamation-circle"></i> Belum dijawab</span></div>`;
                }
            });
            
            html += '</div>';
        });
        
        document.getElementById('summaryContent').innerHTML = html;
        new bootstrap.Modal(document.getElementById('summaryModal')).show();
    }

    // Confirm and submit
    function confirmSubmit() {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah semua jawaban sudah benar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4e73df',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Kirim',
            cancelButtonText: 'Batal'
        }).then(result => {
            if (result.isConfirmed) {
                Swal.fire({ title: 'Menyimpan...', allowOutsideClick: false, didOpen: () => Swal.showLoading() });
                document.getElementById('formSurvey').submit();
            }
        });
    }
</script>
@endpush
