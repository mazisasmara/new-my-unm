<?php

namespace Tests\Feature;

use App\Livewire\ManagedLayananList;
use App\Livewire\PublicDirectory;
use App\Models\Group;
use App\Models\Kategori;
use App\Models\Layanan;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class LiveDirectoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_component_sees_changes_on_next_request(): void
    {
        $category = Kategori::forceCreate(['nama_kategori' => 'Universitas', 'slug' => 'universitas', 'urutan' => 1]);
        $group = Group::create(['kategori_id' => $category->id, 'nama_group' => 'Unit', 'slug' => 'unit', 'status' => true]);

        $browserA = Livewire::test(PublicDirectory::class, ['kategoriId' => $category->id, 'kind' => 'layanan'])
            ->assertDontSee('Layanan Baru');

        $service = Layanan::create(['group_id' => $group->id, 'nama_layanan' => 'Layanan Baru', 'status' => true]);
        $browserA->call('$refresh')->assertSee('Layanan Baru');

        $service->update(['status' => false]);
        $browserA->call('$refresh')->assertDontSee('Layanan Baru');
    }

    public function test_admin_component_remains_scoped_to_own_group_after_refresh(): void
    {
        $category = Kategori::forceCreate(['nama_kategori' => 'Universitas', 'slug' => 'universitas', 'urutan' => 1]);
        $own = Group::create(['kategori_id' => $category->id, 'nama_group' => 'Own', 'slug' => 'own']);
        $other = Group::create(['kategori_id' => $category->id, 'nama_group' => 'Other', 'slug' => 'other']);
        $admin = User::create(['username' => 'admin-live', 'email' => 'admin-live@example.test', 'password' => 'password', 'role' => 'admin', 'status' => true, 'group_id' => $own->id]);
        Layanan::create(['group_id' => $other->id, 'nama_layanan' => 'Rahasia']);
        $this->actingAs($admin);

        $browserA = Livewire::test(ManagedLayananList::class, ['group' => (string) $other->id])
            ->assertDontSee('Rahasia');
        Layanan::create(['group_id' => $own->id, 'nama_layanan' => 'Milik Sendiri']);
        $browserA->call('$refresh')->assertSee('Milik Sendiri')->assertDontSee('Rahasia');
    }

    public function test_public_prodi_component_sees_new_links_after_refresh(): void
    {
        $category = Kategori::forceCreate(['nama_kategori' => 'Portal Prodi', 'slug' => 'portal-prodi', 'urutan' => 1]);
        $group = Group::create(['kategori_id' => $category->id, 'nama_group' => 'Fakultas', 'slug' => 'fakultas', 'status' => true]);
        $prodi = Prodi::create(['group_id' => $group->id, 'judul' => 'Portal Teknik', 'status' => true]);

        $browserA = Livewire::test(PublicDirectory::class, ['kategoriId' => $category->id, 'kind' => 'prodi'])
            ->assertDontSee('Tautan Baru');
        $prodi->links()->create(['label' => 'Tautan Baru', 'url' => 'https://example.test']);
        $browserA->call('$refresh')->assertSee('Tautan Baru');
    }
}
