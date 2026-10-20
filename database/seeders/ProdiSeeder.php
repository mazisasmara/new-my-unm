<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            'portal-prodi-pascasarjana' => [
                ['Matematika (S2)', 'https://math-pps.unm.ac.id/'],
                ['Fisika (S2)', 'https://fisika-pps.unm.ac.id/'],
                ['ADMINISTRASI PUBLIK - (S3)', 'https://aps3-pps.unm.ac.id/'],
                ['ILMU ADMINISTRASI PUBLIK - (S2)', 'https://ilmuadmpubliks2-pps.unm.ac.id/'],
                ['SOSIOLOGI - (S3)', 'https://sosiologis3-pps.unm.ac.id/'],
                ['PENDIDIKAN TEKNOLOGI KEJURUAN - (S2)', 'https://ptk-pps.unm.ac.id/'],
                ['PENDIDIKAN MATEMATIKA - (S2)', 'https://pmat-pps.unm.ac.id/'],
                ['PENDIDIKAN FISIKA - (S2)', 'https://pfis-pps.unm.ac.id/'],
                ['PENDIDIKAN KIMIA - (S2)', 'https://kimias2-pps.unm.ac.id/'],
                ['PENDIDIKAN BIOLOGI - (S2)', 'https://pbio-pps.unm.ac.id/'],
                ['PENDIDIKAN JASMANI DAN OLAHRAGA - (S2)', 'https://pjo-pps.unm.ac.id/'],
                ['ILMU PENDIDIKAN - (S3)', 'https://ip-pps.unm.ac.id/'],
                ['BIMBINGAN DAN KONSELING - (S2)', 'https://bk-pps.unm.ac.id/'],
                ['TEKNOLOGI PENDIDIKAN - (S2)', 'https://tp-pps.unm.ac.id/'],
                ['ADMINISTRASI PENDIDIKAN - (S2)', 'https://ap-pps.unm.ac.id/'],
                ['PENELITIAN DAN EVALUASI PENDIDIKAN - (S2)', 'https://pep-pps.unm.ac.id/'],
                ['PENDIDIKAN EKONOMI - (S3)', 'https://pe-pps.unm.ac.id/'],
                ['PENDIDIKAN GEOGRAFI - (S2)', 'https://pgeo-pps.unm.ac.id/'],
                ['PENDIDIKAN ILMU PENGETAHUAN SOSIAL - (S2)', 'https://pips-pps.unm.ac.id/'],
                ['PENDIDIKAN BAHASA - (S3)', 'https://pbs3-pps.unm.ac.id/'],
                ['PENDIDIKAN BAHASA INGGRIS - (S3)', 'https://pbis3-pps.unm.ac.id/'],
                ['PENDIDIKAN BAHASA INGGRIS - (S2)', 'https://pbi-pps.unm.ac.id/'],
                ['PENDIDIKAN BAHASA JERMAN - (S2)', 'https://pbj-pps.unm.ac.id/'],
                ['PENDIDIKAN SENI RUPA - (S2)', 'https://psr-pps.unm.ac.id/'],
                ['PENDIDIKAN BAHASA - (S2)', 'https://pb-pps.unm.ac.id/'],
                ['PENDIDIKAN KEPENDUDUKAN DAN LINGKUNGAN HIDUP - (S32)', 'https://pklhs3-pps.unm.ac.id/'],
                ['PENDIDIKAN KEPENDUDUKAN DAN LINGKUNGAN HIDUP - (S2)', 'https://pklh-pps.unm.ac.id/'],
                ['PENDIDIKAN BAHASA - (S2)', 'https://pb-pps.unm.ac.id/'],
            ],
            'portal-prodi-mipa' => [
                ['MATEMATIKA - (S1)', 'https://math-fmipa.unm.ac.id/'],
                ['FISIKA - (S1)', 'https://fi-fmipa.unm.ac.id/'],
                ['BIOLOGI - (S1)', 'https://bio-fmipa.unm.ac.id/'],
                ['KIMIA - (S1)', 'https://kimia-fmipa.unm.ac.id/'],
                ['STATISTIKA - (S1)', 'https://stat-fmipa.unm.ac.id/'],
                ['GEOGRAFI - (S1)', 'https://geo-fmipa.unm.ac.id/'],
                ['PENDIDIKAN IPA - (S1)', 'https://pendipa-fmipa.unm.ac.id/'],
                ['PENDIDIKAN MATEMATIKA - (S1)', 'https://pmat-fmipa.unm.ac.id/'],
                ['PENDIDIKAN FISIKA - (S1)', 'https://pfi-fmipa.unm.ac.id/'],
                ['PENDIDIKAN KIMIA - (S1)', 'https://pendkim-fmipa.unm.ac.id/'],
                ['PENDIDIKAN BIOLOGI - (S1)', 'https://pbio-fmipa.unm.ac.id/'],
                ['PENDIDIKAN GEOGRAFI - (S1)', 'https://pgeo-fmipa.unm.ac.id/'],
            ],
            'portal-prodi-teknik' => [
                ['TEKNIK ELEKTRONIKA - (D3)', 'https://elka-ft.unm.ac.id/'],
                ['TEKNIK ELEKTRO - (D3)', 'https://elektro-ft.unm.ac.id/'],
                ['TEKNIK MESIN - (D3)', 'https://mesin-ft.unm.ac.id/'],
                ['TEKNIK OTOMOTIF - (D3)', 'https://otomotif-ft.unm.ac.id/'],
                ['TEKNIK SIPIL - (D3)', 'https://sipil-ft.unm.ac.id/'],
                ['PENDIDIKAN TEKNIK MESIN - (S1)', 'https://ptm-ft.unm.ac.id/'],
                ['PENDIDIKAN TEKNOLOGI PERTANIAN - (S1)', 'https://ptp-ft.unm.ac.id/'],
                ['PENDIDIKAN TEKNIK ELEKTRO - (S1)', 'https://pte-ft.unm.ac.id/'],
                ['PENDIDIKAN TEKNIK ELEKTRONIKA - (S1)', 'https://pta-ft.unm.ac.id/'],
                ['PENDIDIKAN GEOGRAFI - (S1)', 'https://ptm-ft.unm.ac.id/'],
                ['PENDIDIKAN TEKNIK OTOMOTIF - (S1)', 'https://pto-ft.unm.ac.id/'],
                ['PENDIDIKAN TEKNIK BANGUNAN - (S1)', 'https://ptb-ft.unm.ac.id/'],
                ['PENDIDIKAN KESEJAHTERAAN KELUARGA - (S1)', 'https://pkk-ft.unm.ac.id/'],
                ['PEND TEKNIK INFORMATIKA DAN KOMPUTER - (S1)', 'https://ptik-ft.unm.ac.id/'],
                ['TATA BUSANA - (D3)', 'https://tatabusana-ft.unm.ac.id/'],
                ['TATA BOGA - (D3)', 'https://tataboga-ft.unm.ac.id/'],
                ['TEKNIK KOMPUTER - (S1)', 'https://tekom-ft.unm.ac.id/'],
                ['PEND VOKASIONAL MEKATRONIKA - (S1)', 'https://mekatronika-ft.unm.ac.id/'],
            ],
            'portal-prodi-fik' => [
                ['PGSD DIKJAS - (D2)', 'https://dikjas-fik.unm.ac.id/'],
                ['PEND JASMANI KESEHATAN DAN REKREASI - (S1)', 'https://pjkr-fik.unm.ac.id/'],
                ['PENDIDIKAN KEPELATIHAN OLAHRAGA - (S1)', 'https://pko-fik.unm.ac.id/'],
                ['ILMU KEOLAHRAGAAN - (S1)', 'https://ikor-fik.unm.ac.id/'],
            ],
            'portal-prodi-fip' => [
                ['PENDIDIKAN GURU TAMAN KANAK-KANAK - (D2)', 'https://pgtk-fip.unm.ac.id/'],
                ['BIMBINGAN DAN KONSELING - (S1)', 'https://bk-fip.unm.ac.id/'],
                ['PENDIDIKAN LUAR BIASA - (S1)', 'https://plb-fip.unm.ac.id/'],
                ['TEKNOLOGI PENDIDIKAN - (S1)', 'https://tp-fip.unm.ac.id/'],
                ['ADMINISTRASI PENDIDIKAN - (S1)', 'https://ap-fip.unm.ac.id/'],
                ['PENDIDIKAN LUAR SEKOLAH - (S1)', 'https://pls-fip.unm.ac.id/'],
                ['PENDIDIKAN GURU SEKOLAH DASAR - (S1)', 'https://pgsd-fip.unm.ac.id/'],
                ['PENDIDIKAN GURU PENDIDIKAN ANAK USIA DINI - (S1)', 'https://pgpaud-fip.unm.ac.id/'],
                ['PJJ PENDIDIKAN GURU SEKOLAH DASAR - (S1)', 'https://pjjpgsd-fip.unm.ac.id/'],
                ['PENDIDIKAN GURU SEKOLAH DASAR - (D2)', 'https://pgsd-d2-fip.unm.ac.id/'],
            ],
            'portal-prodi-fbs' => [
                ['SASTRA INDONESIA - (S1)', 'https://bsi-fbs.unm.ac.id/'],
                ['SASTRA INGGRIS - (S1)', 'https://si-fbs.unm.ac.id/'],
                ['BAHASA INGGRIS - (D3)', 'https://bid3-fbs.unm.ac.id/'],
                ['PENDIDIKAN BAHASA DAN SASTRA INDONESIA - (S1)', 'https://pbsi-fbs.unm.ac.id/'],
                ['PENDIDIKAN BAHASA DAN SASTRA DAERAH - (S1)', 'https://pbsd-fbs.unm.ac.id/'],
                ['PENDIDIKAN BAHASA INGGRIS - (S1)', 'https://pbi-fbs.unm.ac.id/'],
                ['PENDIDIKAN BAHASA ARAB - (S1)', 'https://pba-fbs.unm.ac.id/'],
                ['PENDIDIKAN BAHASA JERMAN - (S1)', 'https://pbj-fbs.unm.ac.id/'],
                ['PENDIDIKAN BAHASA MANDARIN - (S1)', 'https://pbm-fbs.unm.ac.id/'],
                ['UNIT PENJAMINAN MUTU FBS', 'https://upm-fbs.unm.ac.id/'],
                ['CLS FBS', 'https://cls-fbs.unm.ac.id/'],
                ['PERPUSTAKAAN FBS', 'https://perpustakaan-fbs.unm.ac.id/'],
            ],
            'portal-prodi-fis' => [
                ['ILMU ADMINISTRASI NEGARA - (S1)', 'https://ian-fis.unm.ac.id/'],
                ['ILMU ADMINISTRASI BISNIS - (S1)', 'https://adbis-fis.unm.ac.id/'],
                ['SOSIOLOGI - (S1)', 'https://sos-fis.unm.ac.id/'],
                ['PENDIDIKAN SEJARAH - (S1)', 'https://ps-fis.unm.ac.id/'],
                ['PENDIDIKAN SOSIOLOGI - (S1)', 'https://psos-fis.unm.ac.id/'],
                ['PEND PANCASILA DAN KEWARGANEGARAAN - (S1)', 'https://ppkn-fis.unm.ac.id/'],
                ['PENDIDIKAN ADMINISTRASI PERKANTORAN - (S1)', 'https://pap-fis.unm.ac.id/'],
                ['PENDIDIKAN ILMU PENGETAHUAN SOSIAL - (S1)', 'https://pips-fis.unm.ac.id/'],
                ['PENDIDIKAN ANTROPOLOGI - (S1)', 'https://antro-fis.unm.ac.id/'],
            ],
            'portal-prodi-psikologi' => [
                ['PSIKOLOGI - (S1)', 'https://fpsi.unm.ac.id/'],
            ],
            'portal-prodi-fsd' => [
                ['PENDIDIKAN SENDRATASIK - (S1)', 'https://sendratasik-fsd.unm.ac.id/'],
                ['PENDIDIKAN SENI RUPA - (S1)', 'https://senirupa-fsd.unm.ac.id/'],
                ['DESAIN KOMUNIKASI VISUAL - (S1)', 'https://dkv-fsd.unm.ac.id/'],
                ['SENI TARI - (S1)', 'https://senitari-fsd.unm.ac.id/'],
            ],
            'portal-prodi-ekonomi' => [
                ['EKONOMI PEMBANGUNAN - (S1)', 'https://ep-fe.unm.ac.id/'],
                ['MANAJEMEN - (S1)', 'https://manajemen-fe.unm.ac.id/'],
                ['AKUNTANSI - (S1)', 'https://akuntansi-fe.unm.ac.id/'],
                ['AKUNTANSI - (D3)', 'https://akuntansid3-fe.unm.ac.id/'],
                ['PENDIDIKAN EKONOMI - (S1)', 'https://pekon-fe.unm.ac.id/'],
                ['BISNIS DIGITAL - (S1)', 'https://bisdig-fe.unm.ac.id/bisnis-digital/'],
                ['KEWIRAUSAHAAN - (S1)', 'https://fe.unm.ac.id/kewirausahaan/'],
                ['PENDIDIKAN AKUNTANSI - (S1)', 'https://pspa-fe.unm.ac.id/'],
            ],
            'portal-prodi-kedokteran' => [
                ['KEDOKTERAN - (S1)', 'https://fk.unm.ac.id/'],
            ],
        ];

        Prodi::query()->delete();

        foreach ($programs as $groupSlug => $items) {
            $group = Group::where('slug', $groupSlug)->firstOrFail();
            $owner = $group->user()->where('role', 'admin')->first();

            foreach ($items as $index => [$title, $url]) {
                $program = Prodi::create([
                    'group_id' => $group->id,
                    'created_by' => $owner?->id,
                    'judul' => $title,
                    'status' => true,
                    'urutan' => $index + 1,
                ]);

                $program->links()->create([
                    'label' => $title,
                    'url' => $url,
                    'urutan' => 1,
                ]);
            }
        }
    }
}
