<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Layanan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            'universitas-negeri-makassar' => [
                ['Website Resmi UNM', 'Informasi resmi Universitas Negeri Makassar.'],
                ['Sistem Informasi Akademik', 'Pengelolaan kegiatan akademik mahasiswa dan dosen.'],
                ['Penerimaan Mahasiswa Baru', 'Informasi dan pendaftaran calon mahasiswa baru.'],
                ['Sistem Informasi Kepegawaian', 'Layanan administrasi dan data kepegawaian universitas.'],
                ['Portal Penelitian', 'Informasi penelitian, hibah, dan publikasi ilmiah.'],
                ['Portal Pengabdian Masyarakat', 'Layanan kegiatan pengabdian kepada masyarakat.'],
                ['Sistem Persuratan Digital', 'Pengelolaan surat masuk dan surat keluar secara digital.'],
                ['Layanan Kerja Sama', 'Informasi kerja sama dalam dan luar negeri.'],
                ['Pusat Bahasa UNM', 'Layanan pelatihan dan tes kemampuan bahasa.'],
                ['Layanan Teknologi Informasi', 'Dukungan sistem, jaringan, dan akun institusi.'],
                ['Repository Institusi', 'Koleksi karya ilmiah dan publikasi sivitas akademika.'],
                ['Portal Alumni', 'Informasi alumni, tracer study, dan peluang karier.'],
                ['Sistem Informasi Aset', 'Pendataan dan pengelolaan aset universitas.'],
                ['Layanan Pengaduan Publik', 'Penyampaian aspirasi dan pengaduan layanan kampus.'],
                ['Kalender Akademik', 'Jadwal kegiatan akademik universitas.'],
            ],
            'fakultas-teknik' => [
                ['Website Fakultas Teknik', 'Informasi akademik dan kegiatan Fakultas Teknik.'],
                ['Laboratorium Fakultas Teknik', 'Informasi fasilitas dan peminjaman laboratorium teknik.'],
                ['Praktik Industri Teknik', 'Pendaftaran dan pemantauan praktik industri mahasiswa teknik.'],
                ['Jurnal Fakultas Teknik', 'Publikasi penelitian dosen dan mahasiswa Fakultas Teknik.'],
                ['Layanan Akademik Teknik', 'Administrasi akademik khusus Fakultas Teknik.'],
            ],
            'fakultas-ekonomi' => [
                ['Website Fakultas Ekonomi', 'Informasi akademik dan kegiatan Fakultas Ekonomi.'],
                ['Laboratorium Bisnis', 'Layanan praktik bisnis dan kewirausahaan mahasiswa.'],
                ['Klinik Akuntansi', 'Konsultasi dan praktik akuntansi untuk mahasiswa.'],
                ['Jurnal Ekonomi dan Bisnis', 'Publikasi ilmiah bidang ekonomi dan bisnis.'],
                ['Layanan Akademik Ekonomi', 'Administrasi akademik khusus Fakultas Ekonomi.'],
            ],
            'fakultas-mipa' => [
                ['Website Fakultas MIPA', 'Informasi akademik dan kegiatan Fakultas MIPA.'],
                ['Laboratorium Sains Terpadu', 'Informasi laboratorium dan praktikum sains.'],
                ['Pusat Olimpiade Sains', 'Pembinaan dan informasi kompetisi sains mahasiswa.'],
                ['Jurnal Sains dan Matematika', 'Publikasi ilmiah bidang sains dan matematika.'],
                ['Layanan Akademik MIPA', 'Administrasi akademik khusus Fakultas MIPA.'],
            ],
            'kemahasiswaan' => [
                ['Portal Kemahasiswaan', 'Pusat informasi kegiatan dan layanan mahasiswa.'],
                ['Informasi Beasiswa', 'Daftar dan pendaftaran program beasiswa mahasiswa.'],
                ['Unit Kegiatan Mahasiswa', 'Informasi organisasi dan unit kegiatan mahasiswa.'],
                ['Bimbingan Konseling', 'Layanan konseling akademik dan pribadi mahasiswa.'],
                ['Pusat Karier', 'Informasi lowongan, magang, dan pengembangan karier.'],
                ['Tracer Study', 'Pendataan lulusan dan perkembangan karier alumni.'],
                ['Prestasi Mahasiswa', 'Pendataan prestasi akademik dan nonakademik.'],
                ['Pengajuan Cuti Akademik', 'Layanan pengajuan cuti perkuliahan mahasiswa.'],
                ['Asrama Mahasiswa', 'Informasi pendaftaran dan layanan asrama kampus.'],
                ['Kartu Tanda Mahasiswa', 'Pengajuan dan penggantian kartu mahasiswa.'],
                ['Layanan Kesehatan Mahasiswa', 'Informasi pemeriksaan dan layanan kesehatan kampus.'],
                ['Program Kreativitas Mahasiswa', 'Informasi dan pengajuan proposal kreativitas mahasiswa.'],
                ['Pertukaran Mahasiswa', 'Informasi program mobilitas dan pertukaran mahasiswa.'],
                ['Kegiatan Relawan', 'Informasi kegiatan sosial dan kerelawanan mahasiswa.'],
                ['Pengaduan Mahasiswa', 'Kanal aspirasi dan pengaduan mahasiswa.'],
            ],
            'perpustakaan-unm' => [
                ['Katalog Buku Online', 'Pencarian koleksi buku perpustakaan.'],
                ['Perpustakaan Digital', 'Akses koleksi buku dan dokumen digital.'],
                ['Repository Skripsi', 'Koleksi skripsi mahasiswa dalam format digital.'],
                ['Repository Tesis', 'Koleksi tesis pascasarjana dalam format digital.'],
                ['Repository Disertasi', 'Koleksi disertasi dalam format digital.'],
                ['Jurnal Elektronik', 'Akses jurnal ilmiah elektronik yang dilanggan.'],
                ['Peminjaman Buku', 'Informasi dan transaksi peminjaman koleksi.'],
                ['Perpanjangan Peminjaman', 'Perpanjangan masa pinjam buku secara daring.'],
                ['Reservasi Buku', 'Pemesanan koleksi sebelum berkunjung.'],
                ['Bebas Pustaka', 'Pengajuan surat keterangan bebas pustaka.'],
                ['Keanggotaan Perpustakaan', 'Pendaftaran dan pengelolaan anggota perpustakaan.'],
                ['Cek Status Pinjaman', 'Pemeriksaan status pinjaman dan tanggal pengembalian.'],
                ['Denda Perpustakaan', 'Informasi tagihan dan pembayaran denda koleksi.'],
                ['Usulan Pengadaan Buku', 'Pengajuan judul buku untuk koleksi baru.'],
                ['Layanan Referensi', 'Bantuan penelusuran sumber referensi akademik.'],
                ['Literasi Informasi', 'Materi dan pelatihan pencarian informasi ilmiah.'],
                ['Cek Plagiarisme', 'Layanan pemeriksaan kemiripan karya ilmiah.'],
                ['Koleksi E-Book', 'Akses buku elektronik berbagai bidang ilmu.'],
                ['Koleksi Prosiding', 'Kumpulan prosiding seminar dan konferensi.'],
                ['Koleksi Karya Dosen', 'Publikasi dan karya ilmiah dosen UNM.'],
                ['Koleksi Langka', 'Informasi koleksi langka dan bernilai sejarah.'],
                ['Pojok Statistik', 'Koleksi dan data statistik untuk penelitian.'],
                ['Pojok Baca Digital', 'Akses sumber bacaan digital pilihan.'],
                ['Ruang Diskusi', 'Reservasi ruang diskusi bagi anggota perpustakaan.'],
                ['Ruang Multimedia', 'Reservasi fasilitas multimedia perpustakaan.'],
                ['Jadwal Perpustakaan', 'Informasi jam operasional dan hari layanan.'],
                ['Agenda Perpustakaan', 'Informasi seminar, pelatihan, dan kegiatan literasi.'],
                ['Tanya Pustakawan', 'Konsultasi langsung dengan pustakawan.'],
                ['Panduan Sitasi', 'Panduan penulisan kutipan dan daftar pustaka.'],
                ['Pengaduan Perpustakaan', 'Kanal saran dan pengaduan layanan perpustakaan.'],
            ],
        ];

        $groupSlugs = array_keys($services);
        Layanan::whereHas('group', fn ($query) => $query->whereIn('slug', $groupSlugs))->delete();
        Layanan::whereHas('group.kategori', fn ($query) => $query->where('slug', 'portal-prodi'))->delete();

        foreach ($services as $groupSlug => $items) {
            $group = Group::where('slug', $groupSlug)->firstOrFail();
            $owner = $group->user()->where('role', 'admin')->firstOrFail();

            foreach ($items as $index => [$name, $description]) {
                Layanan::create([
                    'group_id' => $group->id,
                    'created_by' => $owner->id,
                    'nama_layanan' => $name,
                    'logo' => null,
                    'deskripsi' => $description,
                    'link' => 'https://unm.ac.id/layanan/'.Str::slug($name),
                    'status' => true,
                    'urutan' => $index + 1,
                ]);
            }
        }
    }
}
