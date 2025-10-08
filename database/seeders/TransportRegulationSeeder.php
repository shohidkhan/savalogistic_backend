<?php

namespace Database\Seeders;

use App\Models\TransportRegulation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransportRegulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransportRegulation::insert([
            [
                'description'=>"<h4>Driving Time</h4><ul><li>Max. 9 hours daily driving (extendable to 10 hours twice weekly)</li><li>Max. 56 hours weekly driving</li><li>Max. 90 hours fortnightly driving</li><li>45 min break required after 4.5 hours&nbsp;driving</li></ul>",
                'created_at'=>now(),
            ],
            [
                'description'=>"<h4>Vehicle Weight</h4><ul><li>Standard EU limit: 40 tonnes</li><li>Combined transport: 44 tonnes</li><li>Single axle load: 10 tonnes</li><li>Tandem axle load: 11-19 tonnes</li></ul>",
                'created_at'=>now(),
            ],
            [
                'description'=>"<h4>Customs &amp; Packaging</h4><ul><li>Proper documentation for cross-border shipments is required.</li><li>Mandatory labeling for hazardous goods.</li><li>Load distribution plan for heavy cargo.</li><li>Secure packaging to prevent cargo movement.</li></ul>",
                'created_at'=>now(),
            ],
        ]);
    }
}
