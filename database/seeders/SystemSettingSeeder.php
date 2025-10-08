<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SystemSetting::insert([
            [
                'id'             => 1,
                'title'          => 'The Title',
                'email'          => 'support@gmail.com',
                'system_name'    => 'Laravel Stater Kit',
                'copyright_text' => 'Copyright © 2017 - 2024 DESIGN AND DEVELOPED BY ❤️',
                'logo'           => 'backend/images/logo.png',
                'phone'=>'Spain Contract : +34 935 16 71 71',
                'phone2'=>'Spain Contract : +34 935 16 71 71',
                'favicon'        => 'backend/images/logo.png',
                'opening_time'=>'Mon-Fri: 9:00 - 18:00',
                'opening_time2'=>'Mon-Fri: 9:00 - 18:00',
                'opening_time3'=>'Mon-Fri: 9:00 - 18:00',
                'opening_time4'=>'Mon-Fri: 9:00 - 18:00',
                'address'    => 'Carrer del Empordá 1-7, 08211 Castellar del Valles',
                'address2'    => 'Carrer del Empordá 1-7, 08211 Castellar del Valles',
                'created_at'     => Carbon::now(),
            ],
        ]);
    }
}
