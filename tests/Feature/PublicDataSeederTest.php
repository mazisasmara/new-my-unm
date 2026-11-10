<?php

namespace Tests\Feature;

use App\Models\FooterItem;
use App\Models\Layanan;
use App\Models\Prodi;
use Database\Seeders\FooterItemSeeder;
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
            FooterItemSeeder::class,
        ]);

        $this->assertSame(29, $this->serviceCount('universitas'));
        $this->assertSame(11, $this->serviceCount('fakultas'));
        $this->assertSame(3, $this->serviceCount('mahasiswa'));
        $this->assertSame(9, $this->serviceCount('perpustakaan'));
        $this->assertSame(107, Prodi::whereHas('group.kategori', fn ($query) => $query->where('slug', 'portal-prodi'))->count());
        $this->assertSame(3, FooterItem::where('type', 'contact')->count());
        $this->assertSame(3, FooterItem::where('type', 'social')->count());
        $this->assertSame('info@unm.ac.id', FooterItem::where('label', 'Email')->value('value'));

        Layanan::with(['group.user'])->get()->each(function (Layanan $layanan) {
            $this->assertSame($layanan->group->user->id, $layanan->created_by);
            $this->assertNotEmpty($layanan->deskripsi);
        });

        Prodi::with(['group.user'])->get()->each(function (Prodi $prodi) {
            $this->assertSame($prodi->group->user->id, $prodi->created_by);
            $this->assertCount(1, $prodi->links);
        });

        $technicalService = Layanan::with(['group.user'])
            ->where('nama_layanan', 'TEKNIK')
            ->firstOrFail();

        $this->assertSame('http://ft.unm.ac.id/', $technicalService->link);
        $this->assertSame('fakultas-unm', $technicalService->group->slug);
        $this->assertSame('admin_fakultas_unm', $technicalService->group->user->username);
    }

    private function serviceCount(string $categorySlug): int
    {
        return Layanan::whereHas(
            'group.kategori',
            fn ($query) => $query->where('slug', $categorySlug)
        )->count();
    }
}
