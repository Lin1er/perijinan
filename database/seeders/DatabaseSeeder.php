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

        // Membuat izin
        Permission::create(['name' => 'mengajukan izin']);
        Permission::create(['name' => 'verifikasi izin']);
        Permission::create(['name' => 'validasi jemput']);
        Permission::create(['name' => 'validasi kembali']);

        // Memberikan izin ke peran masing-masing
        $roleOrangtua->givePermissionTo('mengajukan izin');
        $roleGuru->givePermissionTo('verifikasi izin');
        $roleSatpam->givePermissionTo(['validasi jemput', 'validasi kembali']);

        // Membuat user percobaan untuk Satpam dan Guru
        $orangtua = User::create([
            'name' => 'orang tua Test',
            'email' => 'orangtua@example.com',
            'password' => bcrypt('password'), // Ganti dengan password yang aman
        ]);

        $guru = User::create([
            'name' => 'Guru Test',
            'email' => 'guru@example.com',
            'password' => bcrypt('password'), // Ganti dengan password yang aman
        ]);

        $satpam = User::create([
            'name' => 'Satpam Test',
            'email' => 'satpam@example.com',
            'password' => bcrypt('password'), // Ganti dengan password yang aman
        ]);

        // Assign role ke user
        $guru->assignRole('guru');
        $satpam->assignRole('satpam');
        $orangtua->assignROle('orangtua');
    }
}
