<?php

namespace Tests\Feature;

use App\Models\FooterItem;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FooterItemManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_superadmin_can_open_footer_management(): void
    {
        $superadmin = $this->user('superadmin', 'superadmin');
        $admin = $this->user('admin', 'admin');

        $this->actingAs($superadmin)->get(route('superadmin.footer-items.index'))->assertOk();
        $this->actingAs($admin)->get(route('superadmin.footer-items.index'))->assertForbidden();
    }

    public function test_superadmin_can_create_update_and_delete_footer_item(): void
    {
        $superadmin = $this->user('superadmin', 'superadmin');

        $this->actingAs($superadmin)->post(route('superadmin.footer-items.store'), [
            'type' => 'social',
            'label' => 'YouTube UNM',
            'value' => null,
            'url' => 'https://youtube.com/@unm',
            'icon' => 'youtube',
            'urutan' => 1,
            'status' => 1,
        ])->assertRedirect(route('superadmin.footer-items.index'));

        $item = FooterItem::where('label', 'YouTube UNM')->firstOrFail();

        $this->actingAs($superadmin)->put(route('superadmin.footer-items.update', $item), [
            'type' => 'social',
            'label' => 'YouTube Resmi UNM',
            'value' => null,
            'url' => 'https://youtube.com/@unm-resmi',
            'icon' => 'youtube',
            'urutan' => 2,
            'status' => 1,
        ])->assertRedirect(route('superadmin.footer-items.index'));

        $this->assertDatabaseHas('footer_items', ['label' => 'YouTube Resmi UNM', 'urutan' => 2]);

        $this->actingAs($superadmin)->delete(route('superadmin.footer-items.destroy', $item))
            ->assertRedirect();

        $this->assertDatabaseMissing('footer_items', ['id' => $item->id]);
    }

    public function test_public_footer_only_displays_active_items(): void
    {
        Kategori::forceCreate(['nama_kategori' => 'Universitas', 'slug' => 'universitas', 'urutan' => 1]);
        FooterItem::create(['type' => 'contact', 'label' => 'Email', 'value' => 'footer@unm.ac.id', 'icon' => 'email', 'urutan' => 1, 'status' => true]);
        FooterItem::create(['type' => 'contact', 'label' => 'Lama', 'value' => 'hidden@unm.ac.id', 'icon' => 'email', 'urutan' => 2, 'status' => false]);

        $this->get('/')
            ->assertOk()
            ->assertSee('footer@unm.ac.id')
            ->assertDontSee('hidden@unm.ac.id');
    }

    private function user(string $username, string $role): User
    {
        return User::create([
            'username' => $username,
            'email' => $username.'@unm.test',
            'password' => 'password',
            'role' => $role,
            'status' => true,
        ]);
    }
}
