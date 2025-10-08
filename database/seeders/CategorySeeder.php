<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([

            [
                'name'=>'category 1',
                'created_at'=>now(),
            ],
            [
                'name'=>'category 2',
                'created_at'=>now(),
            ],
            [
                'name'=>'category 3',
                'created_at'=>now(),
            ],
            [
                'name'=>'category 4',
                'created_at'=>now(),
            ],
            [
                'name'=>'category 5',
                'created_at'=>now(),
            ],
        ]);
    }
}
