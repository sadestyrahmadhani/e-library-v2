<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'root',
            'member_id' => null,
            'email' => 'root@gmail.com',
            'username' => 'root',
            'password' => Hash::make('root'),
            'role' => 'Administrator'
        ]);

        User::create([
            'name' => 'Agus Sucipto',
            'member_id' => 1,
            'email' => 'agus@gmail.com',
            'username' => 'agus',
            'password' => Hash::make('1234'),
            'role' => 'Member'
        ]);
    }
}
