<?php

namespace Database\Seeders;

use App\Models\Ijin;
use App\Models\User;
use App\Models\Student;
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
        Permission::create(['name' => 'akses admin']);

        // Memberikan izin ke peran masing-masing
        $roleOrangtua->givePermissionTo('mengajukan izin');
        $roleGuru->givePermissionTo(['verifikasi izin','akses_ admin']);
        $roleSatpam->givePermissionTo(['validasi jemput', 'validasi kembali']);

        // Membuat user percobaan untuk Satpam dan Guru
        $orangtua = User::create([
            'name' => 'orang tua Test',
            'email' => 'orangtua@example.com',
            'password' => 'orangtua', // Ganti dengan password yang aman
        ]);
        $orangtua->assignRole('orangtua');

        $guru = User::create([
            'name' => 'Guru Test',
            'email' => 'guru@example.com',
            'password' => 'guru', // Ganti dengan password yang aman
        ]);
        $guru->assignRole('guru');

        $satpam = User::create([
            'name' => 'Satpam Test',
            'email' => 'satpam@example.com',
            'password' => 'satpam', // Ganti dengan password yang aman
        ]);
        $satpam->assignRole('satpam');

        User::create([
            'name' => 'Admin',
            'email' => 'admin@a.c',
            'password' => '123', // Ganti dengan password yang aman
        ]);



        Ijin::factory()->count(10)->create();
    }
}
