<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat peran
        $roleOrangtua = Role::create(['name' => 'orangtua']);
        $roleGuru = Role::create(['name' => 'guru']);
        $roleSatpam = Role::create(['name' => 'satpam']);
        $rolesuperAdmin = Role::create(['name' => 'Super Admin']);
        $waka = Role::create(['name' => 'wakaAsrama']);

        // Membuat izin
        Permission::create(['name' => 'mengajukan izin']);
        Permission::create(['name' => 'verifikasi izin']);
        Permission::create(['name' => 'validasi jemput']);
        Permission::create(['name' => 'validasi kembali']);
        Permission::create(['name' => 'akses admin']);

        // Memberikan izin ke peran masing-masing
        $roleOrangtua->givePermissionTo('mengajukan izin');
        $roleGuru->givePermissionTo(['verifikasi izin', 'akses admin']);
        $roleSatpam->givePermissionTo(['validasi jemput', 'validasi kembali']);
        $waka->givePermissionTo('akses admin', 'mengajukan izin', 'verifikasi izin');

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'phoneNumber' => '08123456789',
            'password' => 'admin', // Ganti dengan password yang aman
        ]);

        $admin->assignRole('Super Admin');

        // User::factory()->count(10)->create();
        // StudentClass::factory()->count(10)->create();
        // Ijin::factory()->count(100)->create();
    }
}

