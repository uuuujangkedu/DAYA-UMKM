<?php

namespace Tests\Feature;

use App\Models\LogAktivitasAdmin;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SuperAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_super_admin_dashboard()
    {
        $response = $this->get('/super-admin');
        $response->assertRedirect('/login');
    }

    public function test_admin_url_redirects_to_super_admin_dashboard()
    {
        $admin = User::factory()->create([
            'role' => 'super_admin',
            'status' => 'aktif',
        ]);

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertRedirect('/super-admin');
    }

    public function test_regular_user_cannot_access_super_admin_dashboard()
    {
        $user = User::factory()->create([
            'role' => 'umkm',
            'status' => 'aktif',
        ]);

        $response = $this->actingAs($user)->get('/super-admin');
        $response->assertStatus(403);
    }

    public function test_super_admin_can_view_dashboard()
    {
        $admin = User::factory()->create([
            'role' => 'super_admin',
            'status' => 'aktif',
        ]);

        $response = $this->actingAs($admin)->get('/super-admin');
        $response->assertStatus(200);
        $response->assertSee('BERANDA');
        $response->assertSee('Grafik Penjualan 7 Hari');
    }

    public function test_super_admin_can_approve_proposal()
    {
        $admin = User::factory()->create([
            'role' => 'super_admin',
            'status' => 'aktif',
        ]);

        $umkmUser = User::factory()->create(['role' => 'umkm']);
        $umkm = Umkm::create([
            'user_id' => $umkmUser->id,
            'nama_usaha' => 'Keripik Tempe Juara',
            'jenis_usaha' => 'Makanan',
            'pemilik' => 'Pak Budi',
            'status_pengajuan' => 'menunggu_verifikasi',
        ]);

        $response = $this->actingAs($admin)->post("/super-admin/pengajuan/{$umkm->id_umkm}/approve");

        $response->assertSessionHas('success');
        $this->assertEquals('terverifikasi', $umkm->fresh()->status_pengajuan);

        // Pastikan log aktivitas tercatat
        $this->assertDatabaseHas('log_aktivitas_admin', [
            'id_pengguna' => $admin->id,
            'aksi' => 'Persetujuan Proposal UMKM',
        ]);
    }

    public function test_super_admin_can_reject_proposal()
    {
        $admin = User::factory()->create([
            'role' => 'super_admin',
            'status' => 'aktif',
        ]);

        $umkmUser = User::factory()->create(['role' => 'umkm']);
        $umkm = Umkm::create([
            'user_id' => $umkmUser->id,
            'nama_usaha' => 'Batik Tulis Eksotik',
            'jenis_usaha' => 'Fashion',
            'pemilik' => 'Ibu Siti',
            'status_pengajuan' => 'menunggu_verifikasi',
        ]);

        $response = $this->actingAs($admin)->post("/super-admin/pengajuan/{$umkm->id_umkm}/reject", [
            'alasan' => 'Dokumen NIB belum terlampir.',
        ]);

        $response->assertSessionHas('success');
        $this->assertEquals('ditolak', $umkm->fresh()->status_pengajuan);

        // Pastikan log aktivitas tercatat
        $this->assertDatabaseHas('log_aktivitas_admin', [
            'id_pengguna' => $admin->id,
            'aksi' => 'Penolakan Proposal UMKM',
        ]);
    }

    public function test_super_admin_can_toggle_user_status()
    {
        $admin = User::factory()->create([
            'role' => 'super_admin',
            'status' => 'aktif',
        ]);

        $targetUser = User::factory()->create([
            'status' => 'aktif',
            'role' => 'investor',
        ]);

        $response = $this->actingAs($admin)->post("/super-admin/users/{$targetUser->id}/toggle-status");

        $response->assertSessionHas('success');
        $this->assertEquals('ditangguhkan', $targetUser->fresh()->status);

        // Toggle back to aktif
        $response2 = $this->actingAs($admin)->post("/super-admin/users/{$targetUser->id}/toggle-status");
        $this->assertEquals('aktif', $targetUser->fresh()->status);
    }

    public function test_super_admin_can_view_activity_logs()
    {
        $admin = User::factory()->create([
            'role' => 'super_admin',
            'status' => 'aktif',
        ]);

        LogAktivitasAdmin::create([
            'id_pengguna' => $admin->id,
            'aksi' => 'Uji Coba Audit Trail',
            'detail_perubahan' => ['test' => true],
            'ip_address' => '127.0.0.1',
        ]);

        $response = $this->actingAs($admin)->get('/super-admin/log-aktivitas');
        $response->assertStatus(200);
        $response->assertSee('LOG AKTIVITAS & SESI ONLINE', false);
        $response->assertSee('Uji Coba Audit Trail');
    }

    public function test_regular_admin_can_handle_proposals_and_acc_users()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        $investor = User::factory()->create([
            'role' => 'investor',
            'status' => 'menunggu_verifikasi',
        ]);

        // Regular admin can approve investor user
        $accResponse = $this->actingAs($admin)->post("/super-admin/users/{$investor->id}/approve");
        $accResponse->assertSessionHas('success');
        $this->assertEquals('aktif', $investor->fresh()->status);

        // Regular admin can view and approve proposal
        $umkmUser = User::factory()->create(['role' => 'umkm']);
        $umkm = Umkm::create([
            'user_id' => $umkmUser->id,
            'nama_usaha' => 'Warung Kopi Senja',
            'jenis_usaha' => 'Makanan',
            'pemilik' => 'Pak Senja',
            'status_pengajuan' => 'menunggu_verifikasi',
        ]);

        $approveResponse = $this->actingAs($admin)->post("/super-admin/pengajuan/{$umkm->id_umkm}/approve");
        $approveResponse->assertSessionHas('success');
        $this->assertEquals('terverifikasi', $umkm->fresh()->status_pengajuan);
    }

    public function test_regular_admin_cannot_access_sensitive_actions()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'status' => 'aktif',
        ]);

        $targetUser = User::factory()->create([
            'role' => 'investor',
            'status' => 'aktif',
        ]);

        // 1. Regular admin CANNOT toggle user status (suspend)
        $toggleResponse = $this->actingAs($admin)->post("/super-admin/users/{$targetUser->id}/toggle-status");
        $toggleResponse->assertStatus(403);

        // 2. Regular admin CANNOT change user roles
        $roleResponse = $this->actingAs($admin)->post("/super-admin/users/{$targetUser->id}/change-role", [
            'role' => 'admin',
        ]);
        $roleResponse->assertStatus(403);

        // 3. Regular admin CANNOT view forensic audit logs
        $logsResponse = $this->actingAs($admin)->get('/super-admin/log-aktivitas');
        $logsResponse->assertStatus(403);
    }

    public function test_super_admin_can_change_user_role()
    {
        $superAdmin = User::factory()->create([
            'role' => 'super_admin',
            'status' => 'aktif',
        ]);

        $user = User::factory()->create([
            'role' => 'investor',
            'status' => 'aktif',
        ]);

        // Change investor to umkm
        $response = $this->actingAs($superAdmin)->post("/super-admin/users/{$user->id}/change-role", [
            'role' => 'umkm',
        ]);

        $response->assertSessionHas('success');
        $this->assertEquals('umkm', $user->fresh()->role);
        $this->assertDatabaseHas('umkm', ['user_id' => $user->id]);

        // Change to regular admin
        $response2 = $this->actingAs($superAdmin)->post("/super-admin/users/{$user->id}/change-role", [
            'role' => 'admin',
        ]);
        $response2->assertSessionHas('success');
        $this->assertEquals('admin', $user->fresh()->role);

        // Cannot change own role
        $selfResponse = $this->actingAs($superAdmin)->post("/super-admin/users/{$superAdmin->id}/change-role", [
            'role' => 'investor',
        ]);
        $selfResponse->assertSessionHas('error');
        $this->assertEquals('super_admin', $superAdmin->fresh()->role);
    }
}
