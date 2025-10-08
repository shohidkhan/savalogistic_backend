<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sectors=[
            [
                'title'=>'Automoitive',
                'sub_title'=>'Secure, on-time delivery of chassis & parts',
                'icon'=>'/backend/images/sector1.png'
            ],
            [
                'title'=>'Health',
                'sub_title'=>'GxP-certified cold chain for medicines & devices',
                'icon'=>'/backend/images/sector1.png'
            ],
            [
                'title'=>'Tecnology',
                'sub_title'=>'ESD-protected transit for sensitive electronics.',
                'icon'=>'/backend/images/sector2.png'
            ],
            [
                'title'=>'Consumption',
                'sub_title'=>'Fast, accurate FMCG distribution with shelf-life care',
                'icon'=>'/backend/images/sector3.png'
            ],
            [
                'title'=>'Chemicals',
                'sub_title'=>'Fully ADR-compliant handling of your hazardous goods',
                'icon'=>'/backend/images/sector4.png'
            ],
            [
                'title'=>'Industrial',
                'sub_title'=>'Engineered transport for oversized machinery.',
                'icon'=>'/backend/images/sector5.png'
            ],
            [
                'title'=>'Energy',
                'sub_title'=>'Safe handling & delivery of heavy energy assets',
                'icon'=>'/backend/images/sector6.png'
            ],
            [
                'title'=>'Fairs',
                'sub_title'=>'Secure, on-time delivery of chassis & parts',
                'icon'=>'/backend/images/sector7.png'
            ],
        ];

        foreach($sectors as $sector){
            Sector::create($sector);
        }
    }
}
