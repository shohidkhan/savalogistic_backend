<?php

namespace Database\Seeders;

use App\Models\OurService;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OurServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'FTL Transport',
                'slug' => Str::slug('FTL Transport'),
                'description' => 'Full Truck Load (FTL) transport uses an entire truck for a single shipment, offering faster transit, less handling, and enhanced security for large deliveries.',
                'image' => 'backend/images/Icon.svg',
                'annual_meter' => '630',
                'annual_tons' => '950',
                'per_year_client' => '150',
                'annual_shipment' => '120',
                'address' => 'Dhaka, Bangladesh',
                'status' => 'active',
            ],
            [
                'title' => 'LTL Transport',
                'slug' => Str::slug('LTL Transport'),
                'description' => 'LTL (Less Than Truckload) transport shares truck space with other shipments, offering cost-effective solutions for smaller loads while ensuring reliable, timely delivery.',
                'image' => 'backend/images/Icon (1).svg',
                'annual_meter' => '630',
                'annual_tons' => '950',
                'per_year_client' => '150',
                'annual_shipment' => '120',
                'address' => 'Chittagong, Bangladesh',
                'status' => 'active',
            ],
            [
                'title' => 'Urgent Transport',
                'slug' => Str::slug('Urgent Transport'),
                'description' => 'Urgent transport ensures rapid delivery for time-sensitive shipments with priority handling and fast transit times.',
                'image' => 'backend/images/Icon (2).svg',
                'annual_meter' => '630',
                'annual_tons' => '950',
                'per_year_client' => '150',
                'annual_shipment' => '120',
                'address' => 'Chittagong, Bangladesh',
                'status' => 'active',
            ],
            [
                'title' => 'Specialized Transport',
                'slug' => Str::slug('Specialized Transport'),
                'description' => 'Specialized transport handles unique, oversized, or fragile goods, offering tailored solutions with equipment designed to ensure safety and compliance during transit.',
                'image' => 'backend/images/Icon (3).svg',
                'annual_meter' => '630',
                'annual_tons' => '950',
                'per_year_client' => '150',
                'annual_shipment' => '120',
                'address' => 'Chittagong, Bangladesh',
                'status' => 'active',
            ],
        ];

        foreach ($services as $service) {
            OurService::create($service);
        }
    }
}
