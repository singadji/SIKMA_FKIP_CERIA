<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SurveyInstrument;
use App\Models\SurveyCategory;
use App\Models\SurveyQuestion;

class SurveyInstrumentSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | INSTRUMEN 1
        |--------------------------------------------------------------------------
        */

        $instrumen1 = SurveyInstrument::create([
            "kode" => "INS-01",
            "nama_instrumen" =>
                "Survey Kepuasan Mahasiswa terhadap Performa Mengajar Dosen",
            "deskripsi" => "Instrumen performa mengajar dosen",
        ]);

        $kategori1 = [
            "Reliability (Keandalan)" => [
                "deskripsi" =>
                    "Kemampuan dosen dalam melaksanakan pembelajaran secara konsisten, akurat, dan sesuai dengan perencanaan.",

                "questions" => [
                    "Dosen hadir tepat waktu sesuai jadwal perkuliahan.",
                    "Dosen menyampaikan materi sesuai dengan RPS/SAP.",
                    "Materi yang disampaikan dosen mudah dipahami.",
                    "Dosen konsisten dalam metode dan sistem penilaian.",
                    "Dosen menguasai materi yang diajarkan.",
                    "Dosen menjelaskan tujuan pembelajaran dengan jelas.",
                    "Dosen memberikan tugas yang relevan dengan materi.",
                    "Dosen menyelesaikan perkuliahan sesuai dengan alokasi waktu.",
                    "Dosen memberikan umpan balik terhadap tugas/ujian.",
                    "Dosen menjalankan perkuliahan sesuai kontrak kuliah.",
                ],
            ],

            "Responsiveness (Daya Tanggap)" => [
                "deskripsi" =>
                    "Kesediaan dan kecepatan dosen dalam membantu mahasiswa dan merespons kebutuhan pembelajaran.",

                "questions" => [
                    "Dosen merespons pertanyaan mahasiswa dengan cepat.",
                    "Dosen bersedia membantu mahasiswa yang mengalami kesulitan belajar.",
                    "Dosen memberikan kesempatan bertanya dan berdiskusi.",
                    "Dosen menanggapi pertanyaan dengan jelas dan memadai.",
                    "Dosen mudah dihubungi di luar jam perkuliahan (email/WA/LMS).",
                    "Dosen memberikan klarifikasi jika terjadi kesalahpahaman materi.",
                    "Dosen terbuka terhadap saran dan masukan mahasiswa.",
                    "Dosen cepat menanggapi pengumpulan tugas atau kendala akademik.",
                    "Dosen menyesuaikan pembelajaran dengan kondisi mahasiswa.",
                    "Dosen menunjukkan kepedulian terhadap kesulitan belajar mahasiswa.",
                ],
            ],

            "Assurance (Jaminan)" => [
                "deskripsi" =>
                    "Pengetahuan, sikap profesional, dan kemampuan dosen dalam menumbuhkan rasa percaya dan aman pada mahasiswa.",

                "questions" => [
                    "Dosen menunjukkan sikap profesional dalam mengajar.",
                    "Dosen bersikap adil dalam penilaian.",
                    "Dosen menjelaskan kriteria penilaian secara transparan.",
                    "Dosen memberikan nilai sesuai dengan capaian belajar.",
                    "Dosen memiliki kompetensi akademik yang baik.",
                    "Dosen mampu menciptakan suasana belajar yang kondusif.",
                    "Dosen percaya diri dalam menyampaikan materi.",
                    "Dosen menjaga etika dan norma akademik.",
                    "Dosen dapat menjadi teladan dalam sikap dan perilaku.",
                    "Dosen memberikan rasa aman dan nyaman dalam perkuliahan.",
                ],
            ],

            "Empathy (Empati)" => [
                "deskripsi" =>
                    "Perhatian, kepedulian, dan pemahaman dosen terhadap kebutuhan serta kondisi mahasiswa.",

                "questions" => [
                    "Dosen memahami perbedaan kemampuan mahasiswa.",
                    "Dosen memperlakukan mahasiswa dengan hormat.",
                    "Dosen bersikap ramah dan terbuka kepada mahasiswa.",
                    "Dosen memberikan perhatian pada mahasiswa yang kurang aktif.",
                    "Dosen mendengarkan pendapat mahasiswa dengan baik.",
                    "Dosen tidak bersikap diskriminatif.",
                    "Dosen memberikan motivasi belajar kepada mahasiswa.",
                    "Dosen memahami kendala akademik maupun nonakademik mahasiswa.",
                    "Dosen bersikap sabar dalam membimbing mahasiswa.",
                    "Dosen menunjukkan kepedulian terhadap perkembangan belajar mahasiswa.",
                ],
            ],

            "Tangible (Bukti Fisik)" => [
                "deskripsi" =>
                    "Penampilan fisik, sarana prasarana, dan media pembelajaran yang digunakan dosen.",

                "questions" => [
                    "Dosen berpenampilan rapi dan sopan.",
                    "Media pembelajaran yang digunakan menarik dan jelas.",
                    "Bahan ajar (slide/modul) mudah diakses mahasiswa.",
                    "Dosen memanfaatkan teknologi pembelajaran dengan baik.",
                    "Tampilan materi perkuliahan terstruktur dan sistematis.",
                    "Sarana pembelajaran (LMS, kelas, alat bantu) mendukung perkuliahan.",
                    "Dosen menggunakan variasi media pembelajaran.",
                    "Materi visual/audio membantu pemahaman mahasiswa.",
                    "Dosen menyiapkan perkuliahan dengan baik.",
                    "Lingkungan kelas/perkuliahan terasa nyaman dan tertata.",
                ],
            ],
        ];

        $this->storeQuestions($instrumen1, $kategori1);

        /*
        |--------------------------------------------------------------------------
        | INSTRUMEN 2
        |--------------------------------------------------------------------------
        */

        $instrumen2 = SurveyInstrument::create([
            "kode" => "INS-02",
            "nama_instrumen" =>
                "Survey Kepuasan Mahasiswa terhadap Layanan Administrasi Akademik",
            "deskripsi" => "Instrumen layanan administrasi akademik",
        ]);

        $kategori2 = [
            "Reliability (Keandalan)" => [
                "deskripsi" =>
                    "Kemampuan layanan administrasi akademik dalam memberikan pelayanan secara tepat, konsisten, dan dapat diandalkan.",

                "questions" => [
                    "Informasi akademik yang diberikan selalu akurat.",
                    "Prosedur administrasi akademik dilaksanakan sesuai ketentuan.",
                    "Pelayanan administrasi diberikan sesuai jadwal yang ditetapkan.",
                    "Dokumen akademik diproses dengan benar tanpa kesalahan.",
                    "Pelayanan KRS/KHS dilakukan secara konsisten.",
                    "Informasi kalender akademik dapat dipercaya.",
                    "Pelayanan surat-menyurat akademik tepat waktu.",
                    "Sistem administrasi akademik berjalan dengan baik.",
                    "Data akademik mahasiswa dikelola secara akurat.",
                    "Layanan administrasi jarang mengalami kesalahan",
                ],
            ],

            "Responsiveness (Daya Tanggap)" => [
                "deskripsi" =>
                    "Kesediaan dan kecepatan petugas dalam mmbantu mahasiswa.",

                "questions" => [
                    "Petugas cepat melayani kebutuhan administrasi mahasiswa.",
                    "Keluhan mahasiswa ditangani dengan segera.",
                    "Petugas mudah dihubungi saat dibutuhkan.",
                    "Permintaan informasi akademik dilayani dengan cepat.",
                    "Petugas sigap membantu mahasiswa yang mengalami kesulitan.",
                    "Waktu tunggu pelayanan relatif singkat.",
                    "Pertanyaan mahasiswa dijawab dengan cepat.",
                    "Pelayanan daring (online) responsif.",
                    "Petugas tidak menunda pelayanan.",
                    "Permasalahan administrasi diselesaikan tepat waktu.",
                ],
            ],

            "Assurance (Jaminan)" => [
                "deskripsi" =>
                    "Pengetahuan, kesopanan, dan kemampuan petugas dalam memberikan rasa percaya.",

                "questions" => [
                    "Petugas memiliki pengetahuan yang memadai.",
                    "Petugas bersikap sopan dan ramah.",
                    "Petugas mampu menjelaskan prosedur dengan jelas.",
                    "Mahasiswa merasa aman dalam mengurus administrasi.",
                    "Petugas bekerja secara profesional.",
                    "Petugas memberikan informasi yang dapat dipercaya.",
                    "Petugas mampu menjawab pertanyaan akademik.",
                    "Layanan administrasi memberikan kepastian hasil.",
                    "Kerahasiaan data mahasiswa terjaga.",
                    "Mahasiswa merasa yakin terhadap kualitas pelayanan.",
                ],
            ],

            "Empathy (Empati)" => [
                "deskripsi" =>
                    "Perhatian dan kepedulian petugas terhadap kebutuhan mahasiswa.",

                "questions" => [
                    "Petugas melayani mahasiswa dengan penuh perhatian.",
                    "Petugas memahami kebutuhan mahasiswa.",
                    "Petugas bersedia membantu tanpa membeda-bedakan.",
                    "Petugas menunjukkan sikap peduli.",
                    "Mahasiswa merasa dihargai.",
                    "Petugas mendengarkan keluhan mahasiswa.",
                    "Pelayanan diberikan secara adil.",
                    "Petugas bersikap sabar dalam melayani.",
                    "Petugas memberikan solusi yang sesuai.",
                    "Petugas menunjukkan kepedulian personal.",
                ],
            ],

            "Tangibles (Bukti Fisik)" => [
                "deskripsi" =>
                    "Kondisi fasilitas dan sarana pendukung layanan administrasi.",

                "questions" => [
                    "Ruang pelayanan administrasi bersih dan rapi.",
                    "Fasilitas ruang tunggu memadai.",
                    "Peralatan administrasi berfungsi dengan baik.",
                    "Sistem informasi akademik mudah diakses.",
                    "Tampilan kantor administrasi nyaman.",
                    "Petugas berpenampilan rapi.",
                    "Sarana teknologi mendukung pelayanan.",
                    "Informasi tertulis mudah dibaca.",
                    "Lokasi pelayanan mudah dijangkau.",
                    "Fasilitas pelayanan sesuai kebutuhan mahasiswa.",
                ],
            ],
        ];

        $this->storeQuestions($instrumen2, $kategori2);

        /*
        |--------------------------------------------------------------------------
        | INSTRUMEN 3
        |--------------------------------------------------------------------------
        */

        $instrumen3 = SurveyInstrument::create([
            "kode" => "INS-03",
            "nama_instrumen" =>
                "Survey Kepuasan Mahasiswa terhadap Fasilitas Pendidikan",
            "deskripsi" => "Instrumen fasilitas pendidikan",
        ]);

        $kategori3 = [
            "Reliability (Keandalan Fasilitas)" => [
                "deskripsi" =>
                    "Kemampuan fasilitas pendidikan dalam memberikan layanan yang konsisten, tepat, dan dapat diandalkan.",

                "questions" => [
                    "Fasilitas ruang kuliah tersedia sesuai jadwal perkuliahan.",
                    "Jumlah ruang kuliah memadai untuk menampung mahasiswa.",
                    "Peralatan pembelajaran berfungsi dengan baik saat digunakan.",
                    "Jaringan internet kampus stabil dan dapat diandalkan.",
                    "Fasilitas laboratorium tersedia sesuai kebutuhan mata kuliah.",
                    "Perpustakaan menyediakan koleksi yang konsisten tersedia.",
                    "Sistem peminjaman fasilitas berjalan sesuai prosedur.",
                    "Fasilitas pendukung (toilet, listrik, air) berfungsi dengan baik.",
                    "Jadwal penggunaan fasilitas jarang mengalami gangguan.",
                    "Fasilitas pendidikan mendukung proses belajar secara berkelanjutan.",
                ],
            ],

            "Responsiveness (Daya Tanggap)" => [
                "deskripsi" =>
                    "Kesigapan pengelola dalam membantu dan merespons kebutuhan mahasiswa terkait fasilitas.",

                "questions" => [
                    "Pengelola cepat merespons keluhan fasilitas.",
                    "Kerusakan fasilitas segera ditangani.",
                    "Informasi terkait penggunaan fasilitas mudah diperoleh.",
                    "Petugas siap membantu ketika terjadi kendala fasilitas.",
                    "Proses perbaikan fasilitas dilakukan tepat waktu.",
                    "Pengelola bersedia menerima masukan mahasiswa.",
                    "Permintaan penggunaan fasilitas diproses dengan cepat.",
                    "Keluhan mahasiswa ditindaklanjuti secara jelas.",
                    "Informasi gangguan fasilitas disampaikan dengan baik.",
                    "Pengelola tanggap terhadap kebutuhan fasilitas akademik.",
                ],
            ],

            "Assurance (Jaminan)" => [
                "deskripsi" =>
                    "Pengetahuan, sikap profesional, dan rasa aman yang diberikan oleh pengelola fasilitas.",

                "questions" => [
                    "Pengelola fasilitas memiliki kompetensi yang memadai.",
                    "Mahasiswa merasa aman menggunakan fasilitas kampus.",
                    "Prosedur penggunaan fasilitas jelas dan mudah dipahami.",
                    "Fasilitas memenuhi standar keselamatan.",
                    "Pengelola bersikap profesional dalam melayani mahasiswa.",
                    "Sistem keamanan fasilitas berjalan dengan baik.",
                    "Mahasiswa percaya pada kualitas fasilitas yang disediakan.",
                    "Aturan penggunaan fasilitas diterapkan secara konsisten.",
                    "Fasilitas mendukung kenyamanan belajar.",
                    "Kampus memberikan jaminan kelayakan fasilitas pendidikan.",
                ],
            ],

            "Empathy (Empati)" => [
                "deskripsi" =>
                    "Perhatian dan kepedulian pengelola terhadap kebutuhan mahasiswa.",

                "questions" => [
                    "Pengelola memahami kebutuhan fasilitas mahasiswa.",
                    "Mahasiswa diperlakukan secara adil dalam penggunaan fasilitas.",
                    "Pengelola bersikap ramah dan sopan.",
                    "Fasilitas memperhatikan kebutuhan mahasiswa berkebutuhan khusus.",
                    "Waktu layanan fasilitas sesuai kebutuhan mahasiswa.",
                    "Mahasiswa diberi kesempatan menyampaikan aspirasi.",
                    "Pengelola menunjukkan kepedulian terhadap kenyamanan mahasiswa.",
                    "Layanan fasilitas mempertimbangkan kepentingan mahasiswa.",
                    "Pengelola bersedia membantu secara personal bila diperlukan.",
                    "Fasilitas mendukung kesejahteraan mahasiswa.",
                ],
            ],

            "Tangible (Bukti Fisik)" => [
                "deskripsi" =>
                    "Kondisi fisik dan kelengkapan fasilitas pendidikan.",

                "questions" => [
                    "Kondisi ruang kuliah bersih dan rapi.",
                    "Sarana belajar (kursi, meja, papan tulis) memadai.",
                    "Peralatan teknologi pembelajaran modern dan layak.",
                    "Fasilitas laboratorium lengkap dan terawat.",
                    "Perpustakaan memiliki ruang yang nyaman.",
                    "Area kampus tertata dengan baik.",
                    "Toilet kampus bersih dan layak digunakan.",
                    "Fasilitas pendukung (parkir, mushola, kantin) memadai.",
                    "Penunjuk arah dan informasi fasilitas jelas.",
                    "Secara keseluruhan fasilitas kampus terlihat profesional.",
                ],
            ],
        ];

        $this->storeQuestions($instrumen3, $kategori3);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE QUESTIONS
    |--------------------------------------------------------------------------
    */

    private function storeQuestions($instrument, $categories)
    {
        $urutanKategori = 1;

        foreach ($categories as $namaKategori => $item) {
            $category = SurveyCategory::create([
                "instrument_id" => $instrument->id,
                "nama_kategori" => $namaKategori,

                "deskripsi" => $item["deskripsi"],

                "urutan" => $urutanKategori++,
            ]);

            $nomor = 1;

            foreach ($item["questions"] as $question) {
                SurveyQuestion::create([
                    "instrument_id" => $instrument->id,
                    "category_id" => $category->id,
                    "nomor" => $nomor++,
                    "pertanyaan" => $question,
                ]);
            }
        }
    }
}
