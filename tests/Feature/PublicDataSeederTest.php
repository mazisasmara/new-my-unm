<?php

namespace Tests\Feature;

use App\Models\Layanan;
use App\Models\Prodi;
use Database\Seeders\GroupSeeder;
use Database\Seeders\KategoriSeeder;
use Database\Seeders\LayananSeeder;
use Database\Seeders\ProdiSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicDataSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_seeders_create_the_requested_counts_with_correct_owners(): void
    {
        $this->seed([
            KategoriSeeder::class,
            GroupSeeder::class,
            UserSeeder::class,
            LayananSeeder::class,
            ProdiSeeder::class,
        ]);

        $this->assertSame(15, $this->serviceCount('universitas'));
        $this->assertSame(15, $this->serviceCount('fakultas'));
        $this->assertSame(15, $this->serviceCount('mahasiswa'));
        $this->assertSame(30, $this->serviceCount('perpustakaan'));
        $this->assertSame(30, Prodi::whereHas('group.kategori', fn ($query) => $query->where('slug', 'portal-prodi'))->count());

        Layanan::with(['group.user'])->get()->each(function (Layanan $layanan) {
            $this->assertSame($layanan->group->user->id, $layanan->created_by);
        });

        Prodi::with(['group.user'])->get()->each(function (Prodi $prodi) {
            $this->assertSame($prodi->group->user->id, $prodi->created_by);
            $this->assertCount(2, $prodi->links);
        });

        $technicalService = Layanan::with(['group.user'])
            ->where('nama_layanan', 'Website Fakultas Teknik')
            ->firstOrFail();

        $this->assertSame('fakultas-teknik', $technicalService->group->slug);
        $this->assertSame('admin_ft', $technicalService->group->user->username);
    }

    private function serviceCount(string $categorySlug): int
    {
        return Layanan::whereHas(
            'group.kategori',
            fn ($query) => $query->where('slug', $categorySlug)
        )->count();
    }
}
