<?php

namespace Database\Seeders;

use App\Models\OurServiceFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OurServiceFeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            [
                'our_service_id' => 1,
                'feature_title' => 'Explanation',
                'feature_description' => 'Full Truck Load (FTL) transport uses an entire truck for a single shipment, offering faster transit, less handling, and enhanced security for large deliveries.',
                'feature_image' => 'backend/images/Vector.svg',

            ],
            [
                'our_service_id' => 1,
                'feature_title' => 'Advantages',
                'feature_description' => 'LTL transport is cost-effective, dedicating a truck to one shipment, lowering costs. It speeds up delivery with no stops and reduces damage risk, keeping cargo secure. Ideal for large shipments, it ensures timely and safe delivery.',
                'feature_image' => 'backend/images/Frame (1).svg',

            ],
            [
                'our_service_id' => 1,
                'feature_title' => 'FTL History',
                'feature_description' => 'Full Truck Load (FTL) transport has evolved significantly since its inception, originally designed for businesses needing efficient movement of large goods. As demand for quicker shipping increased, FTL became the go-to method, allowing companies to fill entire trucks for single shipments. This streamlined logistics, improved safety, and lowered costs. Technological advancements have further enhanced FTL services, solidifying their role in todays supply chains.',
                'feature_image' => 'backend/images/Frame (2).svg',

            ],
             [
                'our_service_id' => 2,
                'feature_title' => 'Explanation',
                'feature_description' => 'Full Truck Load (FTL) transport uses an entire truck for a single shipment, offering faster transit, less handling, and enhanced security for large deliveries.',
                'feature_image' => 'backend/images/Vector.svg',

            ],
            [
                'our_service_id' => 2,
                'feature_title' => 'Advantages',
                'feature_description' => 'LTL transport is cost-effective, dedicating a truck to one shipment, lowering costs. It speeds up delivery with no stops and reduces damage risk, keeping cargo secure. Ideal for large shipments, it ensures timely and safe delivery.',
                'feature_image' => 'backend/images/Frame (1).svg',

            ],
            [
                'our_service_id' => 2,
                'feature_title' => 'FTL History',
                'feature_description' => 'Full Truck Load (FTL) transport has evolved significantly since its inception, originally designed for businesses needing efficient movement of large goods. As demand for quicker shipping increased, FTL became the go-to method, allowing companies to fill entire trucks for single shipments. This streamlined logistics, improved safety, and lowered costs. Technological advancements have further enhanced FTL services, solidifying their role in todays supply chains.',
                'feature_image' => 'backend/images/Frame (2).svg',

            ],
            [
                'our_service_id' => 2,
                'feature_title' => 'FTL History',
                'feature_description' => 'Full Truck Load (FTL) transport has evolved significantly since its inception, originally designed for businesses needing efficient movement of large goods. As demand for quicker shipping increased, FTL became the go-to method, allowing companies to fill entire trucks for single shipments. This streamlined logistics, improved safety, and lowered costs. Technological advancements have further enhanced FTL services, solidifying their role in todays supply chains.',
                'feature_image' => 'backend/images/Vector.svg',

            ],
            [
                'our_service_id' => 3,
                'feature_title' => 'Explanation',
                'feature_description' => 'Full Truck Load (FTL) transport uses an entire truck for a single shipment, offering faster transit, less handling, and enhanced security for large deliveries.',
                'feature_image' => 'backend/images/Vector.svg',

            ],
            [
                'our_service_id' => 3,
                'feature_title' => 'Advantages',
                'feature_description' => 'LTL transport is cost-effective, dedicating a truck to one shipment, lowering costs. It speeds up delivery with no stops and reduces damage risk, keeping cargo secure. Ideal for large shipments, it ensures timely and safe delivery.',
                'feature_image' => 'backend/images/Frame (1).svg',

            ],
            [
                'our_service_id' => 3,
                'feature_title' => 'FTL History',
                'feature_description' => 'Full Truck Load (FTL) transport has evolved significantly since its inception, originally designed for businesses needing efficient movement of large goods. As demand for quicker shipping increased, FTL became the go-to method, allowing companies to fill entire trucks for single shipments. This streamlined logistics, improved safety, and lowered costs. Technological advancements have further enhanced FTL services, solidifying their role in todays supply chains.',
                'feature_image' => 'backend/images/Frame (2).svg',

            ],
            [
                'our_service_id' => 4,
                'feature_title' => 'Explanation',
                'feature_description' => 'Full Truck Load (FTL) transport uses an entire truck for a single shipment, offering faster transit, less handling, and enhanced security for large deliveries.',
                'feature_image' => 'backend/images/Vector.svg',

            ],
            [
                'our_service_id' => 4,
                'feature_title' => 'Advantages',
                'feature_description' => 'LTL transport is cost-effective, dedicating a truck to one shipment, lowering costs. It speeds up delivery with no stops and reduces damage risk, keeping cargo secure. Ideal for large shipments, it ensures timely and safe delivery.',
                'feature_image' => 'backend/images/Frame (1).svg',

            ],
            [
                'our_service_id' => 4,
                'feature_title' => 'FTL History',
                'feature_description' => 'Full Truck Load (FTL) transport has evolved significantly since its inception, originally designed for businesses needing efficient movement of large goods. As demand for quicker shipping increased, FTL became the go-to method, allowing companies to fill entire trucks for single shipments. This streamlined logistics, improved safety, and lowered costs. Technological advancements have further enhanced FTL services, solidifying their role in todays supply chains.',
                'feature_image' => 'backend/images/Frame (2).svg',

            ],

        ];

        foreach ($features as $feature) {
            OurServiceFeature::create($feature);
        }
    }
}
