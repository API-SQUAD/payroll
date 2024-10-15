<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Set the schema to payroll
        DB::statement('SET search_path TO payroll');

        User::create([
            'nik' => '0000000000000001',
            'fullname' => 'Super Admin',
            'username' => 'root',
            'email' => 'admin@root.com',
            'password' => Hash::make('12345678'),
        ]);

        Role::create([
            'name' => 'superadmin',
            'guard_name' => 'web',
        ]);

        $user = User::where('username', 'root')->first();
        $user->assignRole('superadmin');

        // User::factory(10)->create(); // Menggunakan factory untuk membuat user tambahan
    }
}
