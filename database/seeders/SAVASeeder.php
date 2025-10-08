<?php

namespace Database\Seeders;

use App\Models\CMS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SAVASeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CMS::insert([
            'page_name' => 'about',
            'section_name' => 'about_sava',
            'countries' => 95,
            'offices' => 4000,
            'employees' => 230000,
            'created_at' => now(),
        ]);
    }
}
