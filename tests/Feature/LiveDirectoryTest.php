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

    public function test_home_only_shows_services_owned_by_the_university_category(): void
    {
        $university = Kategori::forceCreate(['nama_kategori' => 'Universitas', 'slug' => 'universitas', 'urutan' => 1]);
        $faculties = Kategori::forceCreate(['nama_kategori' => 'Fakultas', 'slug' => 'fakultas', 'urutan' => 2]);
        $universityGroup = Group::create(['kategori_id' => $university->id, 'nama_group' => 'Universitas Negeri Makassar', 'slug' => 'universitas-negeri-makassar', 'status' => true]);
        $facultyGroup = Group::create(['kategori_id' => $faculties->id, 'nama_group' => 'Fakultas Teknik', 'slug' => 'fakultas-teknik', 'status' => true]);
        Layanan::create(['group_id' => $universityGroup->id, 'nama_layanan' => 'Sistem Akademik', 'deskripsi' => 'Layanan akademik resmi.', 'status' => true]);
        Layanan::create(['group_id' => $facultyGroup->id, 'nama_layanan' => 'Layanan Fakultas Teknik', 'status' => true]);

        $this->get('/')
            ->assertOk()
            ->assertSee('Cari semua layanan UNM')
            ->assertSee('Sistem Akademik')
            ->assertDontSee('Jelajahi berdasarkan')
            ->assertDontSee('Layanan Fakultas Teknik');
    }

    public function test_public_directory_can_be_filtered_to_a_database_faculty_group(): void
    {
        $category = Kategori::forceCreate(['nama_kategori' => 'Fakultas', 'slug' => 'fakultas', 'urutan' => 1]);
        $engineering = Group::create(['kategori_id' => $category->id, 'nama_group' => 'Fakultas Teknik', 'slug' => 'fakultas-teknik', 'status' => true]);
        $science = Group::create(['kategori_id' => $category->id, 'nama_group' => 'Fakultas MIPA', 'slug' => 'fakultas-mipa', 'status' => true]);
        Layanan::create(['group_id' => $engineering->id, 'nama_layanan' => 'Layanan Teknik', 'status' => true]);
        Layanan::create(['group_id' => $science->id, 'nama_layanan' => 'Layanan Sains', 'status' => true]);

        Livewire::test(PublicDirectory::class, [
            'kategoriId' => $category->id,
            'kind' => 'layanan',
            'group' => 'fakultas-teknik',
        ])->assertSee('Layanan Teknik')->assertDontSee('Layanan Sains');
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
