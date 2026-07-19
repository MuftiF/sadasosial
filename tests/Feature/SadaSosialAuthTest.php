<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SadaSosialAuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the welcome page loads successfully.
     */
    public function test_welcome_page_loads(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Sada Sosial');
    }

    /**
     * Test the login page loads successfully.
     */
    public function test_login_page_loads(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Selamat Datang Kembali');
    }

    /**
     * Test guest cannot access dashboard.
     */
    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect('/login');
    }

    /**
     * Test user can log in and view dashboard.
     */
    public function test_user_can_login_and_view_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'validation_status' => 'validated',
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);

        $dashboardResponse = $this->actingAs($user)->get('/dashboard');
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee('Dashboard Utama');
    }

    /**
     * Test pending user is redirected to pending status page.
     */
    public function test_pending_user_is_redirected_to_pending_page(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'validation_status' => 'pending',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertRedirect('/account/pending');

        $pendingResponse = $this->actingAs($user)->get('/account/pending');
        $pendingResponse->assertStatus(200);
        $pendingResponse->assertSee('Pendaftaran Sedang Ditinjau');
    }

    /**
     * Test rejected user is redirected to rejected status page.
     */
    public function test_rejected_user_is_redirected_to_rejected_page(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'validation_status' => 'rejected',
            'validation_note' => 'Dokumen tidak valid',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertRedirect('/account/rejected');

        $rejectedResponse = $this->actingAs($user)->get('/account/rejected');
        $rejectedResponse->assertStatus(200);
        $rejectedResponse->assertSee('Perbaikan Pendaftaran Akun');
        $rejectedResponse->assertSee('Dokumen tidak valid');
    }

    /**
     * Test standard user cannot access user management.
     */
    public function test_standard_user_cannot_access_user_management(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
            'validation_status' => 'validated',
        ]);

        $response = $this->actingAs($user)->get('/admin/users');
        $response->assertRedirect('/dashboard');
    }

    /**
     * Test admin user can access user management.
     */
    public function test_admin_user_can_access_user_management(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/admin/users');
        $response->assertStatus(200);
        $response->assertSee('Manajemen Pengguna');
    }

    /**
     * Test masyarakat registration page loads.
     */
    public function test_masyarakat_registration_page_loads(): void
    {
        $response = $this->get('/register/masyarakat');
        $response->assertStatus(200);
        $response->assertSee('Registrasi Akun Masyarakat');
    }

    /**
     * Test user can register as masyarakat.
     */
    public function test_user_can_register_as_masyarakat(): void
    {
        $response = $this->post('/register/masyarakat', [
            'name' => 'Masyarakat Test',
            'nik' => '1234567890123456',
            'no_kk' => '6543210987654321',
            'kontak' => '08123456789',
            'alamat' => 'Alamat Jalan Test No. 123',
            'email' => 'masyarakat@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => '1',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('users', [
            'email' => 'masyarakat@example.com',
            'account_type' => 'masyarakat',
            'validation_status' => 'pending',
            'nik' => '1234567890123456',
        ]);
    }
}
