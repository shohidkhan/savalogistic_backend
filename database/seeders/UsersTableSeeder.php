<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role' => 'admin',
                'remember_token' => Str::random(10),
                'created_at' => now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role' => 'user',
                'remember_token' => Str::random(10),
                'created_at' => now(),
            ],
            [
                'name' => 'Supplier',
                'email' => 'supplier@supplier.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role' => 'supplier',
                'remember_token' => Str::random(10),
                'created_at' => now(),
            ],
            [
                'name' => 'Diver',
                'email' => 'diver@diver.com',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'role' => 'driver',
                'remember_token' => Str::random(10),
                'created_at' => now(),
            ],
        ]);
    }
}
