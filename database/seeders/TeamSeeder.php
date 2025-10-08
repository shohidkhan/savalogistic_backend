<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Team::insert([
            [
                'name' => 'John Doe',
                'image' => '/backend/images/t.jpg',
                'twitter' => 'https://twitter.com/johndoe',
                'linkedin' => 'https://linkedin.com/in/johndoe',
                'position' => 'Software Engineer',
                'status' => 'active',
                'bio' => 'John is a software engineer with over 10 years of experience in web development.',
            ],
            [
                'name' => 'Jane Smith',
                'image' => '/backend/images/t1.jpg',
                'twitter' => 'https://twitter.com/janesmith',
                'linkedin' => 'https://linkedin.com/in/janesmith',
                'position' => 'Project Manager',
                'status' => 'inactive',
                'bio' => 'Jane is a project manager who specializes in agile methodologies.',
            ],
            [
                'name' => 'Bob Brown',
                'image' => '/backend/images/t2.jpg',
                'twitter' => null,
                'position' => 'Data Analyst',
                'linkedin' => null,
                'status' => 'inactive',
                'bio' => 'Bob is a data analyst who loves working with big data and machine learning.',
            ],
            [
                'name' => 'Bob Brown',
                'image' => '/backend/images/t3.jpg',
                'twitter' => null,
                'position' => 'Data Analyst',
                'linkedin' => null,
                'status' => 'inactive',
                'bio' => 'Bob is a data analyst who loves working with big data and machine learning.',
            ],
        ]);
    }

}
