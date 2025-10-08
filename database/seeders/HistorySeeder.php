<?php

namespace Database\Seeders;

use App\Models\OurHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OurHistory::insert([
            [
                'title'=>'SAVA LOGISTIC ROMANIA IS BORN',
                'description'=>'Alina and Sergio Cioca, after 10 years as drivers in express transport, founded SAVA LOGISTIC, merging their expertise into a family business named after its members: Sergio, Alina, Vlad, and Andrei. They started with their own fleet, now including trailers, rigid trucks, Mega trucks, and vans.',
                'type'=>'Beginning',
                'date'=>'2010-01-01',
                'image'=>'backend/images/h1.png',
                'created_at'=>now(),
            ],
            [
                'title'=>'SAVA LOGISTIC SPAIN IS BORN',
                'description'=>"The purpose of establishing Sava Logistics in Spain was to expand its horizons and encompass transportation from the entire peninsula to Europe, through the acquisition of a warehouse in Sabadell that would serve as the company's warehouse and operations center for the next decade after its founding.",
                'type'=>'Beginning',
                'date'=>'2010-01-01',
                'image'=>'backend/images/h2.png',
                 'created_at'=>now(),
            ],
            [
                'title'=>'EORI REGISTRATION',
                'description'=>"As Brexit's implications grew, we decided to obtain an EORI number to maintain trade between Spain and Great Britain. This number is essential for import and export within the EU, identifying companies in transactions with customs, simplifying procedures, and ensuring compliant trade.",
                'type'=>'Beginning',
                'date'=>'2010-01-01',
                'image'=>'backend/images/h2.png',
                'created_at'=>now(),
            ],
        ]);
    }
}
