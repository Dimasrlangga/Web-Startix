<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate([
            'email' => 'superadmin@gmail.com',
        ], [
            'name' => 'bagas',
            'password' => Hash::make('12345678'),
            'role' => 'superadmin',
        ]);
    }
} 