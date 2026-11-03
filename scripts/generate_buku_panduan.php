<?php

declare(strict_types=1);

/**
 * Generator buku panduan MyUNM berbasis OOXML tanpa dependensi eksternal.
 * Jalankan: php scripts/generate_buku_panduan.php
 */

$root = dirname(__DIR__);
$output = $root.'/buku_panduan.docx';
$screens = '/tmp/myunm-guide-screens';
$media = [];
$relationships = [];
$body = [];
$bookmarkId = 1;
$relId = 10;
$figure = 0;
$numCounter = 0;

function esc(string $value): string
{
    return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
}

function run(string $text, array $opts = []): string
{
    $props = '';
    if ($opts['bold'] ?? false) $props .= '<w:b/>';
    if ($opts['italic'] ?? false) $props .= '<w:i/>';
    if (isset($opts['size'])) $props .= '<w:sz w:val="'.((int) $opts['size'] * 2).'"/><w:szCs w:val="'.((int) $opts['size'] * 2).'"/>';
    if (isset($opts['color'])) $props .= '<w:color w:val="'.esc($opts['color']).'"/>';
    if (isset($opts['font'])) $props .= '<w:rFonts w:ascii="'.esc($opts['font']).'" w:hAnsi="'.esc($opts['font']).'"/>';
    $space = preg_match('/^\s|\s$/u', $text) ? ' xml:space="preserve"' : '';
    return '<w:r>'.($props ? '<w:rPr>'.$props.'</w:rPr>' : '').'<w:t'.$space.'>'.esc($text).'</w:t></w:r>';
}

function p(array|string $content = '', array $opts = []): string
{
    global $numCounter;
    $numCounter = 0;
    if (is_string($content)) $content = [run($content)];
    $pPr = '';
    if (isset($opts['style'])) $pPr .= '<w:pStyle w:val="'.esc($opts['style']).'"/>';
    if (isset($opts['align'])) $pPr .= '<w:jc w:val="'.esc($opts['align']).'"/>';
    if (isset($opts['before']) || isset($opts['after']) || isset($opts['line'])) {
        $pPr .= '<w:spacing'.(isset($opts['before']) ? ' w:before="'.(int)$opts['before'].'"' : '').(isset($opts['after']) ? ' w:after="'.(int)$opts['after'].'"' : '').(isset($opts['line']) ? ' w:line="'.(int)$opts['line'].'" w:lineRule="auto"' : '').'/>';
    }
    if ($opts['keepNext'] ?? false) $pPr .= '<w:keepNext/>';
    if ($opts['pageBreakBefore'] ?? false) $pPr .= '<w:pageBreakBefore/>';
    if ($opts['widow'] ?? true) $pPr .= '<w:widowControl/>';
    return '<w:p>'.($pPr ? '<w:pPr>'.$pPr.'</w:pPr>' : '').implode('', $content).'</w:p>';
}

function heading(string $text, int $level, ?string $bookmark = null, bool $pageBreak = false): string
{
    global $bookmarkId, $numCounter;
    $numCounter = 0;
    $inside = '';
    if ($bookmark) {
        $inside .= '<w:bookmarkStart w:id="'.$bookmarkId.'" w:name="'.esc($bookmark).'"/>';
    }
    $inside .= run($text, ['bold' => true]);
    if ($bookmark) $inside .= '<w:bookmarkEnd w:id="'.$bookmarkId++.'"/>';
    return '<w:p><w:pPr><w:pStyle w:val="Heading'.$level.'"/>'.($pageBreak ? '<w:pageBreakBefore/>' : '').'<w:keepNext/><w:widowControl/></w:pPr>'.$inside.'</w:p>';
}

function pageBreak(): string
{
    return '<w:p><w:r><w:br w:type="page"/></w:r></w:p>';
}

function bullet(string $text, int $level = 0): string
{
    global $numCounter;
    $numCounter = 0;
    return '<w:p><w:pPr><w:numPr><w:ilvl w:val="'.$level.'"/><w:numId w:val="1"/></w:numPr><w:spacing w:after="80"/><w:widowControl/></w:pPr>'.run($text).'</w:p>';
}

function numbered(string $text): string
{
    global $numCounter;
    $numCounter++;
    return '<w:p><w:pPr><w:tabs><w:tab w:val="left" w:pos="720"/></w:tabs><w:ind w:left="720" w:hanging="360"/><w:spacing w:after="100"/><w:widowControl/></w:pPr>'.run($numCounter.'. ').run($text).'</w:p>';
}

function labelPara(string $label, string $text): string
{
    return p([run($label, ['bold' => true]), run(' '.$text)], ['after' => 100]);
}

function table(array $headers, array $rows, array $widths = []): string
{
    $cols = count($headers);
    if (!$widths) $widths = array_fill(0, $cols, (int) floor(9000 / $cols));
    $grid = '<w:tblGrid>'.implode('', array_map(fn($w) => '<w:gridCol w:w="'.$w.'"/>', $widths)).'</w:tblGrid>';
    $tr = '<w:tr><w:trPr><w:tblHeader/></w:trPr>';
    foreach ($headers as $i => $h) {
        $tr .= '<w:tc><w:tcPr><w:tcW w:w="'.$widths[$i].'" w:type="dxa"/><w:shd w:fill="E7E7E7"/><w:vAlign w:val="center"/></w:tcPr>'.p([run($h, ['bold' => true])], ['align' => 'center', 'after' => 0]).'</w:tc>';
    }
    $tr .= '</w:tr>';
    foreach ($rows as $row) {
        $tr .= '<w:tr><w:trPr><w:cantSplit/></w:trPr>';
        foreach ($row as $i => $cell) {
            $tr .= '<w:tc><w:tcPr><w:tcW w:w="'.$widths[$i].'" w:type="dxa"/><w:vAlign w:val="top"/></w:tcPr>'.p((string)$cell, ['after' => 0]).'</w:tc>';
        }
        $tr .= '</w:tr>';
    }
    return '<w:tbl><w:tblPr><w:tblW w:w="9000" w:type="dxa"/><w:tblLayout w:type="fixed"/><w:tblBorders><w:top w:val="single" w:sz="4" w:color="777777"/><w:left w:val="single" w:sz="4" w:color="777777"/><w:bottom w:val="single" w:sz="4" w:color="777777"/><w:right w:val="single" w:sz="4" w:color="777777"/><w:insideH w:val="single" w:sz="4" w:color="B7B7B7"/><w:insideV w:val="single" w:sz="4" w:color="B7B7B7"/></w:tblBorders><w:tblCellMar><w:top w:w="100" w:type="dxa"/><w:left w:w="100" w:type="dxa"/><w:bottom w:w="100" w:type="dxa"/><w:right w:w="100" w:type="dxa"/></w:tblCellMar></w:tblPr>'.$grid.$tr.'</w:tbl>'.p('', ['after' => 100]);
}

function addImage(string $path, string $caption, float $widthInches = 6.25): string
{
    global $media, $relationships, $relId, $figure;
    if (!is_file($path)) return labelPara('Catatan:', 'Gambar tidak tersedia saat dokumen dibuat.');
    $info = getimagesize($path);
    $heightInches = $widthInches * ($info[1] / $info[0]);
    $cx = (int) round($widthInches * 914400);
    $cy = (int) round($heightInches * 914400);
    $rid = 'rId'.$relId++;
    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    $name = 'image'.(count($media) + 1).'.'.$ext;
    $media[$name] = $path;
    $relationships[] = '<Relationship Id="'.$rid.'" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/image" Target="media/'.$name.'"/>';
    $figure++;
    $docPr = 100 + $figure;
    $drawing = '<w:r><w:drawing><wp:inline distT="0" distB="0" distL="0" distR="0"><wp:extent cx="'.$cx.'" cy="'.$cy.'"/><wp:effectExtent l="0" t="0" r="0" b="0"/><wp:docPr id="'.$docPr.'" name="'.esc($caption).'"/><wp:cNvGraphicFramePr><a:graphicFrameLocks xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main" noChangeAspect="1"/></wp:cNvGraphicFramePr><a:graphic xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main"><a:graphicData uri="http://schemas.openxmlformats.org/drawingml/2006/picture"><pic:pic xmlns:pic="http://schemas.openxmlformats.org/drawingml/2006/picture"><pic:nvPicPr><pic:cNvPr id="'.$docPr.'" name="'.esc($name).'"/><pic:cNvPicPr/></pic:nvPicPr><pic:blipFill><a:blip r:embed="'.$rid.'"/><a:stretch><a:fillRect/></a:stretch></pic:blipFill><pic:spPr><a:xfrm><a:off x="0" y="0"/><a:ext cx="'.$cx.'" cy="'.$cy.'"/></a:xfrm><a:prstGeom prst="rect"><a:avLst/></a:prstGeom><a:ln><a:noFill/></a:ln></pic:spPr></pic:pic></a:graphicData></a:graphic></wp:inline></w:drawing></w:r>';
    return p([$drawing], ['align' => 'center', 'after' => 80]).p([run($caption, ['italic' => true, 'size' => 10])], ['align' => 'center', 'after' => 180, 'keepNext' => false]);
}

function hyperlink(string $text, string $url): string
{
    global $relationships, $relId;
    $rid = 'rId'.$relId++;
    $relationships[] = '<Relationship Id="'.$rid.'" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/hyperlink" Target="'.esc($url).'" TargetMode="External"/>';
    return '<w:hyperlink r:id="'.$rid.'">'.run($text, ['color' => '0563C1']).'</w:hyperlink>';
}

// Cover
$logo = $root.'/storage/app/public/layanan-logo/logo-unm.png';
$body[] = p('', ['before' => 1100, 'after' => 300]);
$body[] = addImage($logo, '', 3.2);
$body[] = p([run('BUKU PANDUAN PENGGUNAAN', ['bold' => true, 'size' => 24])], ['align' => 'center', 'before' => 300, 'after' => 260]);
$body[] = p([run('MyUNM', ['bold' => true, 'size' => 20])], ['align' => 'center', 'after' => 120]);
$body[] = p([run('Portal Layanan Universitas Negeri Makassar', ['size' => 14])], ['align' => 'center', 'after' => 900]);
$body[] = p([run('UNIVERSITAS NEGERI MAKASSAR', ['bold' => true, 'size' => 13])], ['align' => 'center', 'after' => 120]);
$body[] = p('Versi Dokumen 1.0', ['align' => 'center', 'after' => 80]);
$body[] = p('2026', ['align' => 'center']);
$body[] = pageBreak();

// TOC
$body[] = heading('DAFTAR ISI', 1, 'toc');
$body[] = p([run('Daftar isi berikut merupakan bidang otomatis Microsoft Word. Klik kanan lalu pilih '), run('Update Field', ['italic' => true]), run(' untuk memperbarui nomor halaman setelah penyuntingan.')], ['after' => 220]);
$body[] = '<w:p><w:r><w:fldChar w:fldCharType="begin" w:dirty="true"/></w:r><w:r><w:instrText xml:space="preserve"> TOC \\o "1-3" \\h \\z \\u </w:instrText></w:r><w:r><w:fldChar w:fldCharType="separate"/></w:r><w:r><w:t>Daftar isi akan tampil setelah bidang diperbarui di Microsoft Word atau LibreOffice.</w:t></w:r><w:r><w:fldChar w:fldCharType="end"/></w:r></w:p>';
$body[] = table(['Bagian', 'Halaman awal'], [
    ['BAB I PENDAHULUAN', '3'],
    ['BAB II PERSIAPAN', '5'],
    ['BAB III ANTARMUKA SISTEM', '7'],
    ['BAB IV PANDUAN PENGGUNAAN', '9'],
    ['BAB V HAK AKSES', '15'],
    ['BAB VI TROUBLESHOOTING', '17'],
    ['BAB VII FAQ', '19'],
    ['BAB VIII PENUTUP', '20'],
], [7600, 1400]);

// BAB I
$body[] = heading('BAB I PENDAHULUAN', 1, 'bab1', true);
$body[] = heading('1.1 Latar Belakang', 2);
$body[] = p('MyUNM merupakan portal direktori layanan Universitas Negeri Makassar. Sistem menyatukan akses ke layanan universitas, fakultas, kemahasiswaan, perpustakaan, dan portal program studi dalam satu antarmuka. Selain halaman publik untuk menemukan tautan layanan, sistem menyediakan panel pengelolaan untuk memelihara informasi, status publikasi, urutan tampilan, dan statistik kunjungan.');
$body[] = p('Buku panduan ini disusun berdasarkan antarmuka, alur, hak akses, dan validasi yang terdapat pada aplikasi. Panduan berfokus pada tindakan pengguna, bukan pada implementasi teknis sistem.');
$body[] = heading('1.2 Tujuan', 2);
$body[] = bullet('Membantu pengunjung menemukan layanan dan portal program studi yang diperlukan.');
$body[] = bullet('Memandu Admin mengelola konten unit yang menjadi tanggung jawabnya.');
$body[] = bullet('Memandu Super Admin memantau sistem serta mengelola akun, konten lintas unit, urutan grup, footer, dan kontak bantuan.');
$body[] = bullet('Menjadi acuan resmi untuk prosedur login, input data, publikasi, dan penanganan masalah umum.');
$body[] = heading('1.3 Gambaran Umum Sistem', 2);
$body[] = p('Halaman publik menampilkan kategori Beranda/Universitas, Fakultas, Portal prodi, Mahasiswa, dan Perpustakaan. Pengguna dapat mencari layanan, membuka detail layanan, kemudian menuju situs eksternal layanan. Pada Portal prodi, pengguna dapat membuka tautan yang dikelompokkan menurut program studi. Jumlah klik dan kunjungan unik dipakai sebagai bahan statistik dashboard.');
$body[] = p('Setelah login, Admin layanan mengelola daftar layanan milik unitnya, sedangkan Admin Portal Prodi mengelola judul program studi beserta kumpulan tautannya. Super Admin memiliki cakupan seluruh unit dan fungsi administrasi tambahan.');
$body[] = heading('1.4 Pengguna Sistem', 2);
$body[] = table(['Kelompok pengguna', 'Keterangan'], [
    ['Pengunjung publik', 'Tidak memerlukan akun. Dapat menelusuri, mencari, melihat detail, dan membuka tautan layanan atau Portal Prodi.'],
    ['Admin', 'Akun pengelola satu grup/unit. Jenis fitur bergantung pada kategori unit: layanan umum atau Portal Prodi.'],
    ['Super Admin', 'Akun dengan kewenangan lintas unit dan pengelolaan administrasi sistem.'],
], [2200, 6800]);

// BAB II
$body[] = heading('BAB II PERSIAPAN', 1, 'bab2', true);
$body[] = heading('2.1 Persyaratan Sistem', 2);
$body[] = bullet('Komputer, laptop, tablet, atau telepon pintar dengan ukuran layar yang memadai.');
$body[] = bullet('Browser modern yang mendukung JavaScript, misalnya Microsoft Edge, Google Chrome, Mozilla Firefox, atau Safari versi yang masih didukung.');
$body[] = bullet('Koneksi jaringan/internet menuju alamat MyUNM.');
$body[] = bullet('Akun Admin atau Super Admin yang aktif untuk mengakses panel pengelolaan. Pengunjung publik tidak memerlukan akun.');
$body[] = heading('2.2 Akses Website', 2);
$body[] = p([run('Konfigurasi project mencantumkan alamat aplikasi '), hyperlink('http://localhost', 'http://localhost'), run('. Alamat tersebut digunakan untuk lingkungan lokal; pada instalasi resmi, gunakan alamat yang diberikan oleh pengelola sistem.')]);
$body[] = numbered('Buka browser.');
$body[] = numbered('Masukkan alamat MyUNM pada bilah alamat browser.');
$body[] = numbered('Pastikan halaman beranda menampilkan navigasi MyUNM dan daftar layanan.');
$body[] = addImage($screens.'/01-beranda.png', 'Gambar 2.1 Halaman Beranda MyUNM');
$body[] = heading('2.3 Login', 2);
$body[] = numbered('Pada halaman publik, klik tombol Login.');
$body[] = numbered('Masukkan Username akun yang telah terdaftar.');
$body[] = numbered('Masukkan Password. Karakter password tidak ditampilkan.');
$body[] = numbered('Klik tombol Masuk.');
$body[] = numbered('Sistem mengarahkan Admin ke Dashboard Admin dan Super Admin ke Dashboard Superadmin.');
$body[] = addImage($screens.'/02-login.png', 'Gambar 2.2 Halaman Login');
$body[] = labelPara('Pesan yang mungkin muncul:', '“Akun tidak ditemukan atau sudah dinonaktifkan.” apabila akun tidak tersedia/tidak aktif, atau “Username atau password salah.” apabila data login tidak cocok.');
$body[] = heading('2.4 Logout', 2);
$body[] = numbered('Pada panel pengelolaan, lihat bagian bawah sidebar.');
$body[] = numbered('Klik tombol Logout.');
$body[] = numbered('Sistem mengakhiri sesi dan mengarahkan pengguna ke halaman login.');
$body[] = p('Selalu lakukan logout ketika menggunakan perangkat bersama. Menutup tab browser saja tidak selalu mengakhiri sesi.');

// BAB III
$body[] = heading('BAB III ANTARMUKA SISTEM', 1, 'bab3', true);
$body[] = heading('3.1 Dashboard', 2);
$body[] = heading('3.1.1 Dashboard Super Admin', 3);
$body[] = p('Dashboard Superadmin menampilkan Total Admin, Total Layanan, Layanan Aktif, Layanan Nonaktif, dan Kunjungan Website. Bagian Statistik Pengunjung menyediakan pilihan periode 7, 14, atau 30 hari, grafik Kunjungan Website, serta grafik Kunjungan Layanan. Tombol Kelola Akun Admin menjadi pintasan ke daftar admin unit.');
$body[] = addImage($screens.'/03-dashboard.png', 'Gambar 3.1 Dashboard Superadmin');
$body[] = heading('3.1.2 Dashboard Admin Layanan', 3);
$body[] = p('Dashboard Admin layanan menampilkan Total Layanan, Layanan Aktif, Layanan Nonaktif, Total Click, grafik Statistik Pengunjung Layanan, dan Top 5 Layanan Terpopuler. Periode grafik dapat dipilih 7, 14, atau 30 hari. Data hanya mencakup unit Admin yang sedang login.');
$body[] = heading('3.1.3 Dashboard Admin Portal Prodi', 3);
$body[] = p('Dashboard Admin Portal Prodi menampilkan Total Portal Prodi, Total Tautan, Total Klik, grafik Pengunjung Tautan Prodi, dan tabel Tautan Terpopuler. Data hanya mencakup Portal Prodi milik grup Admin.');
$body[] = heading('3.2 Navigasi', 2);
$body[] = p('Navigasi publik berada di bagian atas dan berisi Beranda, Fakultas, Portal prodi, Mahasiswa, Perpustakaan, serta Login atau Dashboard. Pada layar kecil, menu dibuka melalui tombol menu.');
$body[] = p('Panel pengelolaan menggunakan sidebar. Menu Super Admin terdiri atas Dashboard Superadmin, Kelola Admin, Seluruh Layanan, Seluruh Portal Prodi, Urutan Grup, dan Kelola Footer. Admin melihat Dashboard Admin serta Kelola Layanan atau Kelola Portal Prodi sesuai unitnya. Bagian Referensi Arsip pada sidebar membuka kategori publik.');
$body[] = heading('3.3 Profil Pengguna', 2);
$body[] = p('Aplikasi menampilkan username dan nama unit pada bagian bawah sidebar, tetapi tidak menyediakan halaman profil, pengubahan username, pengubahan email akun, penggantian password mandiri, atau foto profil. Hubungi pengelola sistem apabila data akun perlu diperbarui.');

// BAB IV
$body[] = heading('BAB IV PANDUAN PENGGUNAAN', 1, 'bab4', true);
$body[] = heading('4.1 Menelusuri dan Mencari Layanan Publik', 2);
$body[] = p('Fitur ini dapat digunakan tanpa login. Kartu layanan hanya menampilkan data berstatus aktif.');
$body[] = numbered('Pilih kategori Beranda, Fakultas, Mahasiswa, atau Perpustakaan.');
$body[] = numbered('Ketik nama layanan atau kata kunci pada kolom pencarian. Saran hasil akan muncul ketika teks diketik.');
$body[] = numbered('Pilih saran yang sesuai atau klik Cari. Klik Reset untuk menghapus kata pencarian.');
$body[] = numbered('Klik Lihat pada kartu layanan untuk membuka halaman detail.');
$body[] = numbered('Periksa nama layanan, pemilik, tanggal dibuat, deskripsi, dan jumlah pengunjung.');
$body[] = numbered('Klik Lihat web nya untuk membuka situs tujuan pada tab baru.');
$body[] = p('Label “paling sering dikunjungi” dapat tampil pada layanan yang memiliki riwayat klik. Apabila sebuah layanan dinonaktifkan oleh pengelola, layanan tersebut tidak ditampilkan pada halaman publik.');
$body[] = heading('4.2 Menggunakan Portal Prodi', 2);
$body[] = numbered('Pilih menu Portal prodi.');
$body[] = numbered('Gunakan pencarian untuk menemukan judul program studi atau nama tautan.');
$body[] = numbered('Temukan kartu program studi di bawah grup/fakultas yang sesuai.');
$body[] = numbered('Klik nama tautan yang diperlukan. Tautan dibuka pada tab baru dan jumlah klik diperbarui oleh sistem.');
$body[] = p('Apabila belum ada portal aktif, sistem menampilkan pesan bahwa Portal prodi belum tersedia.');

$body[] = heading('4.3 Mengelola Layanan', 2);
$body[] = p('Menu Kelola Layanan tersedia bagi Admin layanan. Super Admin menggunakan menu Seluruh Layanan dan dapat memilih grup pemilik. Admin hanya dapat mengelola data milik unitnya.');
$body[] = heading('4.3.1 Melihat, Mencari, dan Memfilter Layanan', 3);
$body[] = numbered('Buka Kelola Layanan atau Seluruh Layanan.');
$body[] = numbered('Gunakan kolom “Cari nama atau deskripsi...” bila diperlukan.');
$body[] = numbered('Super Admin dapat memilih kategori dan grup. Semua pengguna pengelola dapat memilih status.');
$body[] = numbered('Klik Filter. Klik Reset untuk kembali ke daftar awal.');
$body[] = p('Tabel menampilkan layanan, pemilik, pembuat, jumlah klik, status, dan aksi. Ikon pegangan di sisi kiri digunakan untuk mengubah urutan dengan seret dan lepas; perubahan urutan disimpan otomatis.');
$body[] = addImage($screens.'/04-layanan.png', 'Gambar 4.1 Daftar dan Filter Layanan');
$body[] = heading('4.3.2 Menambah Layanan', 3);
$body[] = numbered('Klik + Tambah Layanan.');
$body[] = numbered('Super Admin memilih Pemilik / Grup. Untuk Admin, unit pemilik ditentukan otomatis.');
$body[] = numbered('Isi Nama Layanan. Kolom ini wajib dan maksimal 255 karakter.');
$body[] = numbered('Isi Deskripsi bila diperlukan.');
$body[] = numbered('Isi Link dengan alamat URL yang valid bila layanan memiliki situs tujuan.');
$body[] = numbered('Unggah Logo berupa berkas gambar dengan ukuran maksimal 2 MB bila diperlukan.');
$body[] = numbered('Pilih Status Aktif agar layanan tampil pada halaman publik, atau Nonaktif untuk menyembunyikannya.');
$body[] = numbered('Klik Simpan. Sistem menampilkan pesan “Layanan berhasil ditambahkan.” apabila proses berhasil.');
$body[] = heading('4.3.3 Mengubah dan Mengaktifkan Layanan', 3);
$body[] = numbered('Pada baris layanan, klik Edit.');
$body[] = numbered('Perbarui data yang diperlukan. Logo baru akan menggantikan logo lama.');
$body[] = numbered('Klik Simpan untuk menyimpan perubahan.');
$body[] = p('Status juga dapat diubah langsung melalui tombol Aktifkan atau Nonaktifkan pada daftar. Layanan nonaktif tetap tersedia di panel pengelolaan, tetapi tidak tampil pada halaman publik.');
$body[] = heading('4.3.4 Menghapus Layanan', 3);
$body[] = numbered('Pastikan layanan yang dipilih sudah benar.');
$body[] = numbered('Klik Hapus pada baris layanan.');
$body[] = numbered('Setujui dialog konfirmasi.');
$body[] = p('Penghapusan menghilangkan data layanan dan logo tersimpan yang terkait. Tindakan ini tidak menyediakan pemulihan mandiri; lakukan hanya jika data tidak lagi diperlukan.');

$body[] = heading('4.4 Mengelola Portal Prodi', 2);
$body[] = p('Admin Portal Prodi hanya mengelola portal dalam grupnya. Super Admin dapat mengelola seluruh Portal Prodi dan memilih grup pemilik.');
$body[] = heading('4.4.1 Melihat dan Memfilter Portal Prodi', 3);
$body[] = numbered('Buka Kelola Portal Prodi atau Seluruh Portal Prodi.');
$body[] = numbered('Cari berdasarkan judul atau nama tautan.');
$body[] = numbered('Super Admin dapat memilih grup. Pilih status Aktif atau Nonaktif bila diperlukan.');
$body[] = numbered('Klik Filter; gunakan Reset untuk menghapus kriteria.');
$body[] = addImage($screens.'/05-portal-prodi.png', 'Gambar 4.2 Daftar Portal Prodi');
$body[] = heading('4.4.2 Menambah atau Mengubah Portal Prodi', 3);
$body[] = numbered('Klik + Tambah Prodi, atau klik Edit pada data yang sudah ada.');
$body[] = numbered('Super Admin memilih Pemilik / Grup Portal.');
$body[] = numbered('Isi Judul Prodi dan angka Urutan. Urutan tidak boleh negatif.');
$body[] = numbered('Centang Tampilkan di halaman publik untuk mengaktifkan portal.');
$body[] = numbered('Pada Daftar Tautan, isi Nama tautan dan URL berformat valid. Setiap portal wajib memiliki minimal satu tautan.');
$body[] = numbered('Klik + Tautan untuk menambah baris atau Hapus pada baris tautan yang tidak diperlukan.');
$body[] = numbered('Klik Simpan. Sistem menampilkan informasi keberhasilan dan kembali ke daftar.');
$body[] = heading('4.4.3 Menghapus Portal Prodi', 3);
$body[] = numbered('Klik Hapus pada portal yang dimaksud.');
$body[] = numbered('Setujui konfirmasi setelah memeriksa judul dan pemilik.');
$body[] = p('Penghapusan portal turut menghapus kumpulan tautan di dalamnya. Tidak tersedia tombol pemulihan mandiri.');

$body[] = heading('4.5 Mengelola Akun Admin', 2);
$body[] = p('Fitur ini hanya tersedia bagi Super Admin. Daftar dapat dicari berdasarkan username, email, atau unit, serta difilter berdasarkan kategori dan status.');
$body[] = heading('4.5.1 Menambah Admin dan Unit', 3);
$body[] = numbered('Buka Kelola Admin, lalu klik + Tambah Admin.');
$body[] = numbered('Isi Username yang unik, maksimal 50 karakter.');
$body[] = numbered('Isi Email yang valid dan belum digunakan, maksimal 255 karakter.');
$body[] = numbered('Isi Password minimal 8 karakter.');
$body[] = numbered('Isi Nama Grup / Unit yang unik, maksimal 255 karakter.');
$body[] = numbered('Pilih Kategori.');
$body[] = numbered('Klik Simpan Admin. Akun dibuat aktif dan ditugaskan ke grup baru tersebut.');
$body[] = p('Sistem menerapkan satu akun Admin untuk satu grup pengelola. Tidak tersedia halaman edit akun Admin pada antarmuka saat ini.');
$body[] = heading('4.5.2 Menghapus Admin', 3);
$body[] = numbered('Pada daftar Admin, pastikan akun dan unit yang dipilih benar.');
$body[] = numbered('Klik Hapus dan setujui konfirmasi.');
$body[] = p('Sistem menolak penghapusan apabila grup Admin masih memiliki layanan atau Portal Prodi. Pindahkan atau hapus konten terkait terlebih dahulu melalui fungsi yang tersedia dan sesuai kebijakan organisasi.');

$body[] = heading('4.6 Mengatur Urutan Grup', 2);
$body[] = numbered('Buka menu Urutan Grup.');
$body[] = numbered('Pilih kategori pada daftar pilihan.');
$body[] = numbered('Seret grup melalui pegangan urut ke posisi yang diinginkan.');
$body[] = numbered('Klik Simpan Urutan. Sistem memperbarui posisi grup dalam kategori tersebut.');
$body[] = p('Fitur ini hanya mengubah urutan tampilan; isi layanan atau Portal Prodi tidak berubah.');

$body[] = heading('4.7 Mengelola Footer', 2);
$body[] = p('Fitur Kelola Footer hanya tersedia bagi Super Admin. Data dibagi menjadi Informasi Kontak dan Media Sosial.');
$body[] = numbered('Buka Kelola Footer untuk melihat urutan, label, isi/tautan, ikon, status, dan aksi.');
$body[] = numbered('Klik + Tambah Item atau Edit.');
$body[] = numbered('Pilih Jenis: Informasi kontak atau Media sosial.');
$body[] = numbered('Isi Label, pilih Ikon, tentukan Urutan 0–999, dan pilih Status.');
$body[] = numbered('Untuk informasi kontak, isi Isi informasi; Tautan bersifat opsional. Untuk media sosial, Tautan wajib diisi dengan URL valid.');
$body[] = numbered('Klik Simpan. Hanya item berstatus Aktif yang ditampilkan pada footer publik.');
$body[] = p('Untuk menghapus item, klik Hapus dan setujui dialog konfirmasi. Gunakan skema tautan yang sesuai, misalnya https:// untuk situs, mailto: untuk email, atau tel: untuk telepon.');

$body[] = heading('4.8 Mengatur Kontak Customer Service', 2);
$body[] = p('Super Admin dapat membuka halaman Pengaturan untuk menentukan Email CS yang dipakai oleh tautan Hubungi Tim Support pada halaman login. Halaman ini tersedia bagi Super Admin, tetapi tidak ditampilkan sebagai menu khusus pada sidebar versi aplikasi yang dianalisis.');
$body[] = numbered('Buka halaman Pengaturan melalui tautan yang disediakan pengelola sistem.');
$body[] = numbered('Isi Email CS dengan alamat email yang valid, maksimal 255 karakter.');
$body[] = numbered('Klik Simpan Perubahan.');

$body[] = heading('4.9 Unggah dan Unduh', 2);
$body[] = p('Fitur unggah yang tersedia bagi pengguna adalah unggah logo pada data layanan. Berkas harus dikenali sebagai gambar dan berukuran maksimal 2 MB. Aplikasi tidak menyediakan fitur unduh dokumen atau ekspor data melalui antarmuka yang dianalisis.');

// BAB V
$body[] = heading('BAB V HAK AKSES', 1, 'bab5', true);
$body[] = heading('5.1 Pengunjung Publik', 2);
$body[] = p('Pengunjung publik dapat membuka kategori, mencari layanan, melihat detail, mengakses situs layanan, dan membuka tautan Portal Prodi tanpa login. Pengunjung tidak dapat menambah, mengubah, menonaktifkan, mengurutkan, atau menghapus data.');
$body[] = heading('5.2 Admin Layanan', 2);
$body[] = p('Admin layanan memantau statistik serta mengelola layanan yang berada pada grup/unit akunnya. Admin tidak dapat mengelola akun lain, konten grup lain, urutan grup, footer, atau pengaturan sistem.');
$body[] = heading('5.3 Admin Portal Prodi', 2);
$body[] = p('Admin Portal Prodi memantau statistik Portal Prodi dan mengelola judul program studi serta tautan di dalam grupnya. Admin jenis ini tidak memperoleh menu Kelola Layanan umum.');
$body[] = heading('5.4 Super Admin', 2);
$body[] = p('Super Admin memantau statistik keseluruhan, mengelola akun Admin, seluruh layanan, seluruh Portal Prodi, urutan grup, item footer, dan email bantuan. Saat menambah atau mengubah konten, Super Admin memilih grup pemilik yang sesuai.');
$body[] = heading('5.5 Matriks Hak Akses', 2);
$body[] = table(['Fitur', 'Publik', 'Admin Layanan', 'Admin Portal', 'Super Admin'], [
    ['Telusur dan cari layanan', '✓', '✓', '✓', '✓'],
    ['Buka tautan Portal Prodi', '✓', '✓', '✓', '✓'],
    ['Dashboard statistik unit', '—', '✓', '✓', '—'],
    ['Dashboard statistik keseluruhan', '—', '—', '—', '✓'],
    ['CRUD layanan unit', '—', '✓', '—', '✓ (semua unit)'],
    ['CRUD Portal Prodi unit', '—', '—', '✓', '✓ (semua unit)'],
    ['Kelola akun Admin', '—', '—', '—', '✓'],
    ['Atur urutan grup', '—', '—', '—', '✓'],
    ['Kelola footer', '—', '—', '—', '✓'],
    ['Atur email bantuan', '—', '—', '—', '✓'],
], [2600, 1250, 1650, 1650, 1850]);

// BAB VI
$body[] = heading('BAB VI TROUBLESHOOTING', 1, 'bab6', true);
$body[] = heading('6.1 Masalah Login', 2);
$body[] = labelPara('Masalah:', 'Pesan akun tidak ditemukan/dinonaktifkan atau username/password salah muncul.');
$body[] = labelPara('Kemungkinan Penyebab:', 'Username keliru, password keliru, atau status akun tidak aktif.');
$body[] = labelPara('Solusi:', 'Periksa penulisan username dan password, pastikan Caps Lock sesuai, lalu coba kembali. Jika tetap gagal, gunakan Hubungi Tim Support atau hubungi Super Admin. Jangan membagikan password kepada pihak lain.');
$body[] = heading('6.2 Masalah Input Data', 2);
$body[] = labelPara('Masalah:', 'Form tidak dapat disimpan dan kembali menampilkan kolom isian.');
$body[] = labelPara('Kemungkinan Penyebab:', 'Kolom wajib kosong, teks melebihi batas, URL/email tidak valid, nilai urutan negatif, data unik sudah digunakan, atau Portal Prodi belum memiliki tautan.');
$body[] = labelPara('Solusi:', 'Baca pesan validasi di dekat form, lengkapi kolom wajib, gunakan URL lengkap seperti https://contoh.ac.id, periksa keunikan username/email/nama unit, lalu simpan kembali.');
$body[] = heading('6.3 Masalah Upload', 2);
$body[] = labelPara('Masalah:', 'Logo layanan gagal diunggah.');
$body[] = labelPara('Kemungkinan Penyebab:', 'Berkas bukan gambar, ukuran melebihi 2 MB, atau koneksi terputus saat unggah.');
$body[] = labelPara('Solusi:', 'Gunakan berkas gambar yang valid dengan ukuran tidak lebih dari 2 MB. Perkecil ukuran gambar bila perlu, pastikan koneksi stabil, lalu unggah ulang.');
$body[] = heading('6.4 Data Tidak Tampil di Halaman Publik', 2);
$body[] = labelPara('Masalah:', 'Layanan, Portal Prodi, atau item footer terlihat pada panel tetapi tidak terlihat oleh pengunjung.');
$body[] = labelPara('Kemungkinan Penyebab:', 'Status data Nonaktif atau perubahan belum selesai dimuat pada halaman publik.');
$body[] = labelPara('Solusi:', 'Pastikan status Aktif atau opsi Tampilkan di halaman publik dipilih. Muat ulang halaman publik setelah beberapa saat.');
$body[] = heading('6.5 Grafik Tidak Tampil', 2);
$body[] = labelPara('Masalah:', 'Area grafik dashboard kosong atau tidak diperbarui.');
$body[] = labelPara('Kemungkinan Penyebab:', 'Belum ada riwayat kunjungan pada periode yang dipilih, JavaScript diblokir, atau koneksi ke sumber grafik bermasalah.');
$body[] = labelPara('Solusi:', 'Pilih periode lain, muat ulang halaman, pastikan JavaScript diizinkan, dan coba browser modern. Hubungi pengelola bila masalah berulang.');
$body[] = heading('6.6 Penghapusan Admin Ditolak', 2);
$body[] = labelPara('Masalah:', 'Akun Admin tidak dapat dihapus.');
$body[] = labelPara('Kemungkinan Penyebab:', 'Grup Admin masih memiliki layanan atau Portal Prodi.');
$body[] = labelPara('Solusi:', 'Periksa konten milik unit tersebut. Pindahkan atau hapus konten sesuai kewenangan dan kebijakan data, lalu ulangi penghapusan akun.');

// BAB VII
$body[] = heading('BAB VII FAQ', 1, 'bab7', true);
$faqs = [
    ['Apakah pengunjung harus login?', 'Tidak. Login hanya diperlukan untuk panel pengelolaan.'],
    ['Mengapa saya hanya melihat Kelola Layanan atau Kelola Portal Prodi?', 'Menu Admin ditentukan oleh kategori grup akun. Admin layanan dan Admin Portal Prodi memiliki fungsi yang berbeda.'],
    ['Bagaimana cara menampilkan data pada halaman publik?', 'Aktifkan status layanan/item footer atau centang Tampilkan di halaman publik untuk Portal Prodi.'],
    ['Apakah saya dapat mengubah password sendiri?', 'Tidak. Aplikasi yang dianalisis belum menyediakan halaman profil atau perubahan password mandiri. Hubungi pengelola sistem.'],
    ['Mengapa tautan layanan tidak dapat disimpan?', 'Pastikan alamat menggunakan format URL yang valid, misalnya diawali https://.'],
    ['Berapa ukuran maksimum logo layanan?', 'Maksimal 2 MB dan berkas harus berupa gambar yang valid.'],
    ['Apakah urutan layanan dapat diubah?', 'Ya. Pada daftar layanan, seret data melalui pegangan urut. Admin mengurutkan layanan unitnya.'],
    ['Apakah Portal Prodi boleh tanpa tautan?', 'Tidak. Setiap Portal Prodi wajib memiliki minimal satu tautan dengan label dan URL valid.'],
    ['Mengapa layanan yang saya nonaktifkan masih ada di panel?', 'Status Nonaktif hanya menyembunyikan data dari halaman publik; data tetap ada agar dapat dikelola atau diaktifkan kembali.'],
    ['Bisakah data yang sudah dihapus dipulihkan?', 'Tidak ada fungsi pemulihan mandiri pada antarmuka. Periksa data dan konfirmasi sebelum menghapus.'],
    ['Apa arti jumlah klik dan pengunjung unik?', 'Klik mencatat pembukaan tautan, sedangkan grafik pengunjung unik mengelompokkan kunjungan menurut identitas jaringan pada periode tertentu.'],
    ['Apakah tersedia ekspor atau unduh data?', 'Tidak. Antarmuka yang dianalisis tidak menyediakan ekspor atau unduh data.'],
];
foreach ($faqs as $i => [$q, $a]) {
    $body[] = p([run(($i + 1).'. '.$q, ['bold' => true])], ['keepNext' => true, 'after' => 50]);
    $body[] = p($a, ['after' => 160]);
}

// BAB VIII
$body[] = heading('BAB VIII PENUTUP', 1, 'bab8', true);
$body[] = p('Buku panduan ini menjadi acuan penggunaan MyUNM bagi pengunjung, Admin, dan Super Admin. Pengguna diharapkan mengikuti hak akses masing-masing, memeriksa data sebelum menyimpan atau menghapus, menjaga kerahasiaan akun, dan melakukan logout setelah selesai menggunakan panel pengelolaan.');
$body[] = p('Apabila terdapat perubahan antarmuka atau fitur pada versi aplikasi berikutnya, buku panduan perlu ditinjau dan diperbarui agar tetap sesuai dengan kondisi sistem. Untuk kendala yang tidak dapat diselesaikan melalui bagian troubleshooting, hubungi pengelola sistem atau gunakan tautan Hubungi Tim Support pada halaman login.');

$document = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'.
'<w:document xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships" xmlns:wp="http://schemas.openxmlformats.org/drawingml/2006/wordprocessingDrawing" xmlns:a="http://schemas.openxmlformats.org/drawingml/2006/main" xmlns:pic="http://schemas.openxmlformats.org/drawingml/2006/picture"><w:body>'.implode('', $body).
'<w:sectPr><w:headerReference w:type="default" r:id="rId2"/><w:footerReference w:type="default" r:id="rId3"/><w:pgSz w:w="11906" w:h="16838"/><w:pgMar w:top="1134" w:right="1134" w:bottom="1134" w:left="1417" w:header="600" w:footer="600" w:gutter="0"/><w:cols w:space="708"/><w:docGrid w:linePitch="360"/></w:sectPr></w:body></w:document>';

$styles = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><w:styles xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main">'.
'<w:docDefaults><w:rPrDefault><w:rPr><w:rFonts w:ascii="Aptos" w:hAnsi="Aptos" w:eastAsia="Aptos"/><w:color w:val="000000"/><w:sz w:val="22"/><w:szCs w:val="22"/><w:lang w:val="id-ID"/></w:rPr></w:rPrDefault><w:pPrDefault><w:pPr><w:spacing w:after="140" w:line="276" w:lineRule="auto"/><w:jc w:val="both"/><w:widowControl/></w:pPr></w:pPrDefault></w:docDefaults>'.
'<w:style w:type="paragraph" w:default="1" w:styleId="Normal"><w:name w:val="Normal"/><w:qFormat/></w:style>'.
'<w:style w:type="paragraph" w:styleId="Heading1"><w:name w:val="heading 1"/><w:basedOn w:val="Normal"/><w:next w:val="Normal"/><w:uiPriority w:val="9"/><w:qFormat/><w:pPr><w:keepNext/><w:keepLines/><w:spacing w:before="360" w:after="220"/><w:outlineLvl w:val="0"/></w:pPr><w:rPr><w:b/><w:color w:val="000000"/><w:sz w:val="32"/><w:szCs w:val="32"/></w:rPr></w:style>'.
'<w:style w:type="paragraph" w:styleId="Heading2"><w:name w:val="heading 2"/><w:basedOn w:val="Normal"/><w:next w:val="Normal"/><w:uiPriority w:val="9"/><w:qFormat/><w:pPr><w:keepNext/><w:keepLines/><w:spacing w:before="280" w:after="140"/><w:outlineLvl w:val="1"/></w:pPr><w:rPr><w:b/><w:color w:val="000000"/><w:sz w:val="27"/><w:szCs w:val="27"/></w:rPr></w:style>'.
'<w:style w:type="paragraph" w:styleId="Heading3"><w:name w:val="heading 3"/><w:basedOn w:val="Normal"/><w:next w:val="Normal"/><w:uiPriority w:val="9"/><w:qFormat/><w:pPr><w:keepNext/><w:keepLines/><w:spacing w:before="220" w:after="100"/><w:outlineLvl w:val="2"/></w:pPr><w:rPr><w:b/><w:color w:val="000000"/><w:sz w:val="24"/><w:szCs w:val="24"/></w:rPr></w:style></w:styles>';

$numbering = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><w:numbering xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"><w:abstractNum w:abstractNumId="0"><w:multiLevelType w:val="hybridMultilevel"/><w:lvl w:ilvl="0"><w:start w:val="1"/><w:numFmt w:val="bullet"/><w:lvlText w:val="•"/><w:lvlJc w:val="left"/><w:pPr><w:tabs><w:tab w:val="num" w:pos="720"/></w:tabs><w:ind w:left="720" w:hanging="360"/></w:pPr></w:lvl></w:abstractNum><w:abstractNum w:abstractNumId="1"><w:multiLevelType w:val="singleLevel"/><w:lvl w:ilvl="0"><w:start w:val="1"/><w:numFmt w:val="decimal"/><w:lvlText w:val="%1."/><w:lvlJc w:val="right"/><w:pPr><w:tabs><w:tab w:val="num" w:pos="720"/></w:tabs><w:ind w:left="720" w:hanging="360"/></w:pPr></w:lvl></w:abstractNum><w:num w:numId="1"><w:abstractNumId w:val="0"/></w:num><w:num w:numId="2"><w:abstractNumId w:val="1"/></w:num></w:numbering>';

$header = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><w:hdr xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"><w:p><w:pPr><w:jc w:val="right"/><w:spacing w:after="0"/><w:pBdr><w:bottom w:val="single" w:sz="4" w:space="4" w:color="808080"/></w:pBdr></w:pPr>'.run('Buku Panduan Penggunaan MyUNM', ['size' => 9]).'</w:p></w:hdr>';
$footer = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><w:ftr xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"><w:p><w:pPr><w:jc w:val="center"/><w:spacing w:before="0" w:after="0"/></w:pPr><w:r><w:fldChar w:fldCharType="begin"/></w:r><w:r><w:instrText> PAGE </w:instrText></w:r><w:r><w:fldChar w:fldCharType="end"/></w:r></w:p></w:ftr>';
$settings = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><w:settings xmlns:w="http://schemas.openxmlformats.org/wordprocessingml/2006/main"><w:updateFields w:val="true"/><w:defaultTabStop w:val="720"/><w:compat><w:compatSetting w:name="compatibilityMode" w:uri="http://schemas.microsoft.com/office/word" w:val="15"/></w:compat></w:settings>';
$core = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><cp:coreProperties xmlns:cp="http://schemas.openxmlformats.org/package/2006/metadata/core-properties" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:dcterms="http://purl.org/dc/terms/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><dc:title>Buku Panduan Penggunaan MyUNM</dc:title><dc:subject>Panduan pengguna portal layanan Universitas Negeri Makassar</dc:subject><dc:creator>Universitas Negeri Makassar</dc:creator><cp:keywords>MyUNM; buku panduan; layanan; portal prodi</cp:keywords><dc:description>Dokumentasi penggunaan MyUNM berdasarkan aplikasi versi September 2026.</dc:description><cp:lastModifiedBy>Universitas Negeri Makassar</cp:lastModifiedBy><dcterms:created xsi:type="dcterms:W3CDTF">2026-09-18T00:00:00Z</dcterms:created><dcterms:modified xsi:type="dcterms:W3CDTF">2026-09-18T00:00:00Z</dcterms:modified></cp:coreProperties>';
$app = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Properties xmlns="http://schemas.openxmlformats.org/officeDocument/2006/extended-properties"><Application>Microsoft Office Word</Application><AppVersion>16.0000</AppVersion><Company>Universitas Negeri Makassar</Company></Properties>';

$rels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/><Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/header" Target="header1.xml"/><Relationship Id="rId3" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/footer" Target="footer1.xml"/><Relationship Id="rId4" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/numbering" Target="numbering.xml"/><Relationship Id="rId5" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/settings" Target="settings.xml"/>'.implode('', $relationships).'</Relationships>';
$packageRels = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="word/document.xml"/><Relationship Id="rId2" Type="http://schemas.openxmlformats.org/package/2006/relationships/metadata/core-properties" Target="docProps/core.xml"/><Relationship Id="rId3" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/extended-properties" Target="docProps/app.xml"/></Relationships>';
$types = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types"><Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/><Default Extension="xml" ContentType="application/xml"/><Default Extension="png" ContentType="image/png"/><Default Extension="jpg" ContentType="image/jpeg"/><Default Extension="jpeg" ContentType="image/jpeg"/><Override PartName="/word/document.xml" ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.document.main+xml"/><Override PartName="/word/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.styles+xml"/><Override PartName="/word/numbering.xml" ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.numbering+xml"/><Override PartName="/word/settings.xml" ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.settings+xml"/><Override PartName="/word/header1.xml" ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.header+xml"/><Override PartName="/word/footer1.xml" ContentType="application/vnd.openxmlformats-officedocument.wordprocessingml.footer+xml"/><Override PartName="/docProps/core.xml" ContentType="application/vnd.openxmlformats-package.core-properties+xml"/><Override PartName="/docProps/app.xml" ContentType="application/vnd.openxmlformats-officedocument.extended-properties+xml"/></Types>';

if (!class_exists(ZipArchive::class)) {
    fwrite(STDERR, "Ekstensi ZipArchive tidak tersedia.\n");
    exit(1);
}
$zip = new ZipArchive();
if ($zip->open($output, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
    fwrite(STDERR, "Tidak dapat membuat $output\n");
    exit(1);
}
$zip->addFromString('[Content_Types].xml', $types);
$zip->addFromString('_rels/.rels', $packageRels);
$zip->addFromString('docProps/core.xml', $core);
$zip->addFromString('docProps/app.xml', $app);
$zip->addFromString('word/document.xml', $document);
$zip->addFromString('word/styles.xml', $styles);
$zip->addFromString('word/numbering.xml', $numbering);
$zip->addFromString('word/settings.xml', $settings);
$zip->addFromString('word/header1.xml', $header);
$zip->addFromString('word/footer1.xml', $footer);
$zip->addFromString('word/_rels/document.xml.rels', $rels);
foreach ($media as $name => $path) $zip->addFile($path, 'word/media/'.$name);
$zip->close();

echo "Dibuat: $output\n";
echo 'Screenshot: '.(count($media) - 1)."\n";
