<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Layanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            'universitas-negeri-makassar' => [
                ['PORTAL UNM', 'Portal resmi Universitas Negeri Makassar untuk berita, informasi, profil, dan agenda universitas.', 'http://unm.ac.id/'],
                ['SIA', 'Sistem Informasi Akademik untuk mengakses dan mengelola kegiatan akademik sivitas UNM.', 'https://sia.unm.ac.id'],
                ['SITRANS', 'Layanan informasi dan pengelolaan transaksi administrasi di lingkungan UNM.', 'http://sitrans.unm.ac.id/trans/'],
                ['SIMPEG', 'Sistem informasi untuk pengelolaan data dan administrasi kepegawaian UNM.', 'http://simpeg.unm.ac.id'],
                ['EPRINTS', 'Repositori digital karya ilmiah, penelitian, dan publikasi sivitas akademika UNM.', 'http://eprints.unm.ac.id/'],
                ['LMS', 'Platform pembelajaran daring untuk mendukung perkuliahan dan aktivitas belajar mengajar.', 'http://lms.unm.ac.id'],
                ['OJS', 'Portal jurnal ilmiah elektronik yang diterbitkan dan dikelola di lingkungan UNM.', 'http://ojs.unm.ac.id'],
                ['PUSTAKA', 'Portal utama layanan, informasi, dan koleksi Perpustakaan Universitas Negeri Makassar.', 'http://perpustakaan.unm.ac.id'],
                ['REGISTRASI', 'Layanan registrasi dan administrasi pendaftaran mahasiswa Universitas Negeri Makassar.', 'http://registrasi.unm.ac.id'],
                ['SIMAWA', 'Sistem informasi untuk layanan, kegiatan, dan administrasi kemahasiswaan UNM.', 'http://simawa.unm.ac.id'],
                ['SIMUKT', 'Sistem informasi pengelolaan Uang Kuliah Tunggal bagi mahasiswa UNM.', 'http://simukt.unm.ac.id'],
                ['SIMKKN', 'Sistem informasi pendaftaran dan pengelolaan Kuliah Kerja Nyata mahasiswa UNM.', 'http://kkn.unm.ac.id'],
                ['EDOM', 'Layanan Evaluasi Dosen oleh Mahasiswa untuk mendukung peningkatan mutu pembelajaran.', 'http://edom.unm.ac.id'],
                ['OCS', 'Sistem pengelolaan konferensi untuk pendaftaran, pengiriman karya, dan informasi kegiatan ilmiah.', 'http://ocs.unm.ac.id'],
                ['PENGUMUMAN', 'Pusat informasi pengumuman resmi Universitas Negeri Makassar.', 'http://pengumuman.unm.ac.id'],
                ['PMBM', 'Portal informasi dan layanan penerimaan mahasiswa baru Universitas Negeri Makassar.', 'http://pmbm.unm.ac.id'],
                ['SISTER', 'Sistem informasi sumber daya terintegrasi untuk data pendidik dan tenaga kependidikan.', 'http://sister.unm.ac.id'],
                ['TRACER STUDY', 'Layanan pendataan lulusan untuk memantau perkembangan karier dan masukan alumni.', 'http://tracerstudy.unm.ac.id'],
                ['SiRemun', 'Sistem informasi pengelolaan remunerasi pegawai Universitas Negeri Makassar.', 'http://remun.unm.ac.id/home.html'],
                ['Monitoring SSO UNM', 'Layanan pemantauan akses Single Sign-On dan konektivitas jaringan UNM.', 'https://venue.wifi.id/'],
                ['SimLP2M', 'Sistem informasi penelitian dan pengabdian kepada masyarakat di lingkungan UNM.', 'https://simlp2m.unm.ac.id/'],
                ['PPID UNM', 'Layanan Pejabat Pengelola Informasi dan Dokumentasi untuk keterbukaan informasi publik.', 'http://ppid.unm.ac.id/'],
                ['SimPengaduan', 'Kanal penyampaian pengaduan, aspirasi, dan masukan terkait layanan Universitas Negeri Makassar.', 'http://pengaduan.unm.ac.id/'],
                ['SYAM-OK UNM', 'Platform pembelajaran daring UNM untuk mengakses kelas, materi, tugas, dan aktivitas kuliah.', 'https://syam-ok.unm.ac.id/'],
                ['E-Presensi UNM', 'Aplikasi presensi elektronik untuk mendukung pencatatan kehadiran di lingkungan UNM.', 'https://play.google.com/store/apps/details?id=com.unm.presensi'],
                ['SIM-PA UNM', 'Sistem informasi perwalian akademik untuk mahasiswa dan dosen penasihat akademik.', 'https://perwalian.unm.ac.id/'],
                ['SIM-MBKM UNM', 'Sistem informasi kegiatan Merdeka Belajar Kampus Merdeka Universitas Negeri Makassar.', 'http://sim.mbkm.unm.ac.id/'],
                ['e-Regist', 'Layanan registrasi elektronik untuk proses administrasi mahasiswa UNM.', 'http://e-registrasi.unm.ac.id/'],
                ['Si-Nilai', 'Sistem informasi untuk pengelolaan dan akses nilai akademik mahasiswa UNM.', 'https://si-nilai.unm.ac.id/'],
            ],
            'fakultas-unm' => [
                ['PASCASARJANA', 'Portal informasi akademik, program studi, penelitian, dan layanan Program Pascasarjana UNM.', 'http://pps.unm.ac.id/'],
                ['MIPA', 'Portal resmi Fakultas Matematika dan Ilmu Pengetahuan Alam Universitas Negeri Makassar.', 'http://fmipa.unm.ac.id/'],
                ['TEKNIK', 'Portal resmi Fakultas Teknik untuk informasi akademik, program studi, dan kegiatan fakultas.', 'http://ft.unm.ac.id/'],
                ['KEOLAHRAGAAN', 'Portal resmi Fakultas Ilmu Keolahragaan dan Kesehatan Universitas Negeri Makassar.', 'http://fik.unm.ac.id/'],
                ['PENDIDIKAN', 'Portal resmi Fakultas Ilmu Pendidikan untuk informasi akademik dan kegiatan fakultas.', 'http://fip.unm.ac.id/'],
                ['BAHASA SASTRA', 'Portal resmi Fakultas Bahasa dan Sastra untuk informasi akademik dan kegiatan fakultas.', 'http://fbs.unm.ac.id/'],
                ['SOSIAL', 'Portal resmi Fakultas Ilmu Sosial dan Hukum Universitas Negeri Makassar.', 'http://fis.unm.ac.id/'],
                ['PSIKOLOGI', 'Portal resmi Fakultas Psikologi untuk informasi akademik, layanan, dan kegiatan fakultas.', 'http://fpsi.unm.ac.id/'],
                ['SENI DESAIN', 'Portal resmi Fakultas Seni dan Desain untuk informasi program studi dan kegiatan akademik.', 'http://fsd.unm.ac.id/'],
                ['EKONOMI', 'Portal resmi Fakultas Ekonomi dan Bisnis untuk informasi akademik dan kegiatan fakultas.', 'http://fe.unm.ac.id/'],
                ['KEDOKTERAN', 'Portal resmi Fakultas Kedokteran untuk informasi akademik, program studi, dan layanan fakultas.', 'http://fk.unm.ac.id/'],
            ],
            'kemahasiswaan' => [
                ['BIDIKMISI', 'Portal informasi dan kegiatan mahasiswa penerima bantuan pendidikan Bidikmisi UNM.', 'http://ikbim.mhs.unm.ac.id/'],
                ['SAR', 'Portal kegiatan mahasiswa Search and Rescue Universitas Negeri Makassar.', 'http://sar.mhs.unm.ac.id/'],
                ['GRAMATIKA', 'Portal pers mahasiswa Gramatika untuk publikasi, informasi, dan kegiatan jurnalistik kampus.', 'http://persgramatika.mhs.unm.ac.id/'],
            ],
            'perpustakaan-unm' => [
                ['JURNAL UNM', 'Portal kumpulan jurnal ilmiah yang diterbitkan di lingkungan Universitas Negeri Makassar.', 'http://ojs.unm.ac.id/'],
                ['OPAC', 'Katalog daring untuk mencari koleksi buku dan bahan pustaka yang tersedia di perpustakaan.', 'http://pustaka.unm.ac.id/'],
                ['E-JOURNAL', 'Layanan akses jurnal elektronik sebagai sumber referensi akademik dan penelitian.', 'http://perpustakaan.unm.ac.id/index.php/e-journal'],
                ['DIGILIB', 'Perpustakaan digital untuk mengakses berbagai koleksi dan sumber belajar dalam format elektronik.', 'http://digilib.unm.ac.id/'],
                ['EPRINT', 'Repositori karya ilmiah dan publikasi digital sivitas akademika Universitas Negeri Makassar.', 'http://eprints.unm.ac.id/'],
                ['SI PERPUSTAKAAN', 'Sistem informasi untuk pencarian koleksi dan layanan administrasi perpustakaan UNM.', 'http://pustaka.unm.ac.id/'],
                ['TESIS UNM', 'Portal koleksi tesis dan karya ilmiah mahasiswa Pascasarjana Universitas Negeri Makassar.', 'http://thesis.unm.ac.id/'],
                ['E-BOOK', 'Layanan koleksi buku elektronik untuk menunjang pembelajaran, pengajaran, dan penelitian.', 'http://ebook.unm.ac.id/'],
                ['OER', 'Koleksi sumber pembelajaran terbuka yang dapat dimanfaatkan oleh sivitas akademika UNM.', 'http://oer.unm.ac.id/'],
            ],
        ];

        Layanan::query()->delete();

        foreach ($services as $groupSlug => $items) {
            $group = Group::where('slug', $groupSlug)->firstOrFail();
            $owner = $group->user()->where('role', 'admin')->first();

            foreach ($items as $index => [$name, $description, $url]) {
                Layanan::create([
                    'group_id' => $group->id,
                    'created_by' => $owner?->id,
                    'nama_layanan' => $name,
                    'logo' => null,
                    'deskripsi' => $description,
                    'link' => $url,
                    'status' => true,
                    'urutan' => $index + 1,
                ]);
            }
        }
    }
}
