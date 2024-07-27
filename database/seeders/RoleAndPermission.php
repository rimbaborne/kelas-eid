<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'manage']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('manage');

        $role = Role::create(['name' => 'agen']);
        $role->givePermissionTo('manage');

        $role = Role::create(['name' => 'agen-plus']);
        $role->givePermissionTo('manage');


        // membuat user admin
        $userAdmin = \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@kelasentrepreneurid.com',
            'email_verified_at' => now(),
            'phone_code' => '62',
            'phone_number' => '8125144744',
            'show_password' => 'qweqweqwe',
            'password' => \Illuminate\Support\Facades\Hash::make('Pratamart45'),
            'remember_token' => \Illuminate\Support\Str::random(10),
        ]);

        // assign role admin dan agen-plus
        $userAdmin->assignRole(['admin', 'agen-plus']);


        // buat data kelas
        $kelas = \App\Models\Kelas::create([
            'nama' => 'Kelas Profit 10 Juta',
            'slug' => 'kelas-profit-10-juta',
            'harga_coret' => 125000,
            'harga' => 57000,
            'komisi_agen' => 25000,
            'komisi_sub_agen' => 0,
            'gambar' => 'https://admin.entrepreneurid.org/img/produk/KPS-2024-1.png',
            'link' => 'https://kelasentrepreneurid.com/kelas-profit-10-juta',
            'tampil' => 1,
            'aktif' => 1,
            'mulai_event' => now(),
            'akhir_event' => now()->addDays(10),
        ]);
    }
}

