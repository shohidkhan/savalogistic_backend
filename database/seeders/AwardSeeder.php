<?php

namespace Database\Seeders;

use App\Models\Award;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Award::insert([
            [
                'name'=>'Mariya Khanom',
                'award_subject'=>'Best dance performer',
                'year'=>2020,
                'image'=>'/backend/images/aw.jpg',
            ],
            [
                'name'=>'Sumona Khanom',
                'award_subject'=>'Best Fight performer',
                'year'=>2021,
                'image'=>'/backend/images/aw.jpg',
            ]
            ,
            [
                'name'=>'Rajeaya Khanom',
                'award_subject'=>'Best teacher performer',
                'year'=>2022,
                'image'=>'/backend/images/aw.jpg',
            ]
        ]);
    }
}
