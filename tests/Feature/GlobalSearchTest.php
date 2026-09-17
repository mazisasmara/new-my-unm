<?php

namespace Tests\Feature;

use App\Livewire\GlobalSearch;
use App\Models\Group;
use App\Models\Kategori;
use App\Models\Layanan;
use App\Models\Prodi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class GlobalSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_suggestions_search_all_public_categories_and_use_real_destinations(): void
    {
        $universitas = Kategori::forceCreate([
            'nama_kategori' => 'Universitas',
            'slug' => 'universitas',
            'urutan' => 1,
        ]);
        $fakultas = Kategori::forceCreate([
            'nama_kategori' => 'Fakultas',
            'slug' => 'fakultas',
            'urutan' => 2,
        ]);
        $universityGroup = Group::create([
            'kategori_id' => $universitas->id,
            'nama_group' => 'Universitas Negeri Makassar',
            'slug' => 'universitas-negeri-makassar',
            'status' => true,
        ]);
        $engineering = Group::create([
            'kategori_id' => $fakultas->id,
            'nama_group' => 'Fakultas Teknik',
            'slug' => 'fakultas-teknik',
            'status' => true,
        ]);
        $service = Layanan::create([
            'group_id' => $universityGroup->id,
            'nama_layanan' => 'Portal UNM',
            'deskripsi' => 'Layanan utama kampus',
            'status' => true,
        ]);

        Livewire::test(GlobalSearch::class, ['formAction' => route('home')])
            ->set('query', 'Fakultas Teknik')
            ->assertSee('Fakultas Teknik')
            ->assertSee(url('fakultas'), false)
            ->set('query', 'Portal UNM')
            ->assertSee('Portal UNM')
            ->assertSee(route('layanan.show', $service), false);
    }

    public function test_exact_title_is_ranked_before_partial_title(): void
    {
        $category = Kategori::forceCreate([
            'nama_kategori' => 'Universitas',
            'slug' => 'universitas',
            'urutan' => 1,
        ]);
        $group = Group::create([
            'kategori_id' => $category->id,
            'nama_group' => 'Unit',
            'slug' => 'unit',
            'status' => true,
        ]);
        Layanan::create(['group_id' => $group->id, 'nama_layanan' => 'Portal Akademik UNM', 'status' => true]);
        Layanan::create(['group_id' => $group->id, 'nama_layanan' => 'Portal UNM', 'status' => true]);

        $component = Livewire::test(GlobalSearch::class, ['formAction' => route('home')])
            ->set('query', 'Portal UNM');

        $suggestions = $component->get('suggestions');

        $this->assertSame('Portal UNM', $suggestions[0]['title']);
    }

    public function test_multi_word_query_can_suggest_a_related_program_study(): void
    {
        $category = Kategori::forceCreate([
            'nama_kategori' => 'Portal Prodi',
            'slug' => 'portal-prodi',
            'urutan' => 1,
        ]);
        $group = Group::create([
            'kategori_id' => $category->id,
            'nama_group' => 'Program Studi',
            'slug' => 'program-studi',
            'status' => true,
        ]);
        Prodi::create(['group_id' => $group->id, 'judul' => 'Teknik Informatika', 'status' => true]);

        Livewire::test(GlobalSearch::class, ['formAction' => route('home')])
            ->set('query', 'fakultas teknik')
            ->assertSee('Teknik Informatika');
    }

    public function test_inactive_content_is_not_suggested(): void
    {
        $category = Kategori::forceCreate([
            'nama_kategori' => 'Universitas',
            'slug' => 'universitas',
            'urutan' => 1,
        ]);
        $group = Group::create([
            'kategori_id' => $category->id,
            'nama_group' => 'Nonaktif',
            'slug' => 'nonaktif',
            'status' => false,
        ]);
        Layanan::create(['group_id' => $group->id, 'nama_layanan' => 'Rahasia Internal', 'status' => true]);

        $component = Livewire::test(GlobalSearch::class, ['formAction' => route('home')])
            ->set('query', 'Rahasia Internal');

        $this->assertSame([], $component->get('suggestions'));
    }

    public function test_existing_get_search_filters_portal_prodi(): void
    {
        $category = Kategori::forceCreate([
            'nama_kategori' => 'Portal Prodi',
            'slug' => 'portal-prodi',
            'urutan' => 1,
        ]);
        $group = Group::create([
            'kategori_id' => $category->id,
            'nama_group' => 'Program Studi',
            'slug' => 'program-studi',
            'status' => true,
        ]);
        Prodi::create(['group_id' => $group->id, 'judul' => 'Teknik Informatika', 'status' => true]);
        Prodi::create(['group_id' => $group->id, 'judul' => 'Pendidikan Ekonomi', 'status' => true]);

        $this->get('/portal-prodi?search=Teknik')
            ->assertOk()
            ->assertSee('Teknik Informatika')
            ->assertDontSee('Pendidikan Ekonomi');
    }
}
