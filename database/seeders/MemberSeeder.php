<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::create([
            'name' => 'Agus Sucipto',
            'phone' => '0898768758477',
            'email' => 'agus@gmail.com',
            'address' => 'Banyuwangi'
        ]);
    }
}
