<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        SocialMedia::insert([
            [
                'id'           => 1,
                'social_media' => 'facebook',
                'social_media_icon'=>'/frontend/f.jpg',
                'profile_link' => 'https://www.facebook.com/',
                'created_at'     => Carbon::now(),
            ],
            [
                'id'           => 2,
                'social_media' => 'twitter',
                'social_media_icon'=>'/frontend/x.jpg',
                'profile_link' => 'https://x.com/?lang=en',
                'created_at'     => Carbon::now(),
            ],
            [
                'id'           => 3,
                'social_media' => 'linkedin',
                'social_media_icon'=>'/frontend/l.jpg',
                'profile_link' => 'https://bd.linkedin.com/',
                'created_at'     => Carbon::now(),
            ],
            [
                'id'           => 4,
                'social_media' => 'instagram',
                'social_media_icon'=>'/frontend/i.jpg',
                'profile_link' => 'https://www.instagram.com/',
                'created_at'     => Carbon::now(),
            ],
        ]);
    }
}
