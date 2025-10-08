<?php

namespace Database\Seeders;

use App\Models\CMR;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CMRSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CMR::insert([
            [
                'title'=>'CMR Convention',
                'sub_title'=>'International agreement for cross-border road transport contracts',
                'description'=>'<p>The CMR (Convention on the Contract for the International Carriage of Goods by Road) is an international convention that standardizes the conditions governing contracts for the international carriage of goods by road. It applies to any contract for the carriage of goods by road in vehicles when the place of taking over the goods and the place of delivery are situated in different countries.</p><h4>Why is CMR required?</h4><ul><li>Creates a standardized framework for transport contracts across different countries.</li><li>Defines transport liability limits and compensation procedures.</li><li>Provides legal protection for both senders and carriers.</li><li>Serves as proof of shipping instructions and receipt of goods.</li><li>Required documentation for customs clearance in many countries</li></ul>',
                'overview'=>"<p>A CMR consignment note must include the following information:</p><ul><li>Date and place of completion</li><li>Name and address of sender, carrier, and consignee</li><li>Place and date of collection and delivery</li><li>Description of goods and packaging method</li><li>Number of packages and weight</li><li>Costs related to carriage (freight charges, supplementary charges, customs duties)</li><li>Instructions for customs and other formalities</li><li>Statement that carriage is subject to CMR convention</li></ul>",
                'sender_responsibilities'=>"<p>The sender's responsibilities include:</p><ul><li>Date and place of completion</li><li>Name and address of sender, carrier, and consignee</li><li>Place and date of collection and delivery</li><li>Description of goods and packaging method</li><li>Number of packages and weight</li><li>Costs related to carriage (freight charges, supplementary charges, customs duties)</li><li>Instructions for customs and other formalities</li><li>Statement that carriage is subject to CMR convention</li></ul>",
                'carrier_responsibilities'=>"<p>A CMR consignment note must include the following information:</p><ul><li>Checking the accuracy of the consignment note</li><li>Inspecting the apparent condition of the goods</li><li>Verifying packaging is appropriate</li><li>Recording any reservations on the consignment note</li><li>Safeguarding the goods during transport</li><li><p>Delivering goods to the specified destination</p><p>Note:&nbsp;The carrier is liable for loss or damage occurring between taking over the goods and delivery, as well as for delay in delivery.</p></li></ul>",
                'icon'=>'/frontend/SVG.png',
            ]
        ]);
    }
}
