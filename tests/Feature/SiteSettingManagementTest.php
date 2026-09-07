<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteSettingManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_superadmin_can_update_customer_service_email(): void
    {
        $superadmin = $this->user('superadmin');

        $this->actingAs($superadmin)
            ->put(route('superadmin.settings.update'), [
                'customer_service_email' => 'support@unm.ac.id',
            ])
            ->assertRedirect(route('superadmin.settings.edit'));

        $this->assertDatabaseHas('site_settings', [
            'key' => 'customer_service_email',
            'value' => 'support@unm.ac.id',
        ]);
    }

    public function test_admin_cannot_manage_site_settings(): void
    {
        $this->actingAs($this->user('admin'))
            ->get(route('superadmin.settings.edit'))
            ->assertForbidden();
    }

    public function test_login_page_uses_configured_email_and_has_no_forgot_password_link(): void
    {
        SiteSetting::create([
            'key' => 'customer_service_email',
            'value' => 'cs@unm.ac.id',
        ]);

        $this->get(route('login'))
            ->assertOk()
            ->assertSee('to=cs%40unm.ac.id', false)
            ->assertDontSee('lupa password?', false);
    }

    private function user(string $role): User
    {
        return User::create([
            'username' => $role,
            'email' => $role.'@unm.test',
            'password' => 'password',
            'role' => $role,
            'status' => true,
        ]);
    }
}
