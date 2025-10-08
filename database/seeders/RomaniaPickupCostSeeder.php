<?php

namespace Database\Seeders;

use App\Models\RomaniaPickupCost;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RomaniaPickupCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $ldmRates = [
            ['ldm_id' => 1, 'cost' => 180],
            ['ldm_id' => 2,   'cost' => 207],
            ['ldm_id' => 3,    'cost' => 290],
            ['ldm_id' => 4,    'cost' => 344],
            ['ldm_id' => 5,  'cost' => 399],
            ['ldm_id' => 6,   'cost' => 481],
            ['ldm_id' => 7,   'cost' => 563],
            ['ldm_id' => 8,     'cost' => 618],
            ['ldm_id' => 9,   'cost' => 728],
            ['ldm_id' => 10,   'cost' => 755],
            ['ldm_id' => 11,   'cost' => 837],
            ['ldm_id' => 12,    'cost' => 892],
            ['ldm_id' => 13,   'cost' => 947],
            ['ldm_id' => 14,  'cost' => 1029],
            ['ldm_id' => 15,  'cost' => 1056],
            ['ldm_id' => 16,     'cost' => 1166],
            ['ldm_id' => 17,   'cost' => 1275],
            ['ldm_id' => 18,   'cost' => 1303],
            ['ldm_id' => 19,   'cost' => 1385],
            ['ldm_id' => 20,    'cost' => 1439],
            ['ldm_id' => 21,   'cost' => 1494],
            ['ldm_id' => 22, 'cost' => 1576],
            ['ldm_id' => 23,   'cost' => 1604],
            ['ldm_id' => 24,     'cost' => 1713],
            ['ldm_id' => 25, 'cost' => 1823],
            ['ldm_id' => 26,  'cost' => 1850],
            ['ldm_id' => 27,   'cost' => 1932],
            ['ldm_id' => 28,   'cost' => 1987],
            ['ldm_id' => 29, 'cost' => 2042],
            ['ldm_id' => 30,   'cost' => 2124],
            ['ldm_id' => 31,   'cost' => 2151],
            ['ldm_id' => 32,     'cost' => 2261],
            ['ldm_id' => 33,  'cost' => 2370],
            ['ldm_id' => 34,   'cost' => 2398],
            ['ldm_id' => 35,  'cost' => 2480],
            ['ldm_id' => 36,    'cost' => 2535],
            ['ldm_id' => 37,   'cost' => 2589],
            ['ldm_id' => 38,   'cost' => 2672],
            ['ldm_id' => 39, 'cost' => 2699],
            ['ldm_id' => 40,   'cost' => 2808],
        ];

        foreach ($ldmRates as $rate) {
           RomaniaPickupCost::insert([
                'ldm_id'        => $rate['ldm_id'],
                'cost'       => $rate['cost'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
