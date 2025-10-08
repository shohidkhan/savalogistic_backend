<?php

namespace Database\Seeders;

use App\Models\CMS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CMS::create([
            'page_name'=>'about',
            'section_name'=>'about',
            'description'=>'<p>At <strong>SAVA Logistics</strong>, we’re all about making transport easy and reliable across Europe. Our fantastic team is here to provide great service, helping businesses with smooth road transport, customs support, and smart logistics planning. Whether you’re shipping from Spain to Germany or Italy to Romania, we’ve got your back with CMR-insured shipments, a modern fleet, and loads of market know-how. We don’t just move things — we create lasting partnerships, ensuring every delivery arrives safely, on time, and with a friendly touch.</p>',
            'image_url'=>'/backend/images/b3.png',
        ]);
    }
}
