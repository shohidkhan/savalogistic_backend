<?php

namespace Database\Seeders;

use App\Models\ShippingRate;
use App\Models\TransportNotice;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SocialMediaSeeder::class);
        $this->call(SystemSettingSeeder::class);
        $this->call(DynamicPageSeeder::class);
        $this->call(FaqSeeder::class);
        $this->call(AboutUsSeeder::class);
        $this->call(TeamSeeder::class);
        $this->call(SAVASeeder::class);
        $this->call(HistorySeeder::class);
        $this->call(OurServicesSeeder::class);
        $this->call(OurServiceFeaturesSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(AwardSeeder::class);
        $this->call(CertificateSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(SectorSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(TransportRestrictionSeeder::class);
        $this->call(TransportRegulationSeeder::class);
        $this->call(ComplianceSeeder::class);
        $this->call(CMRSeeder::class);
        $this->call(TransportNoticeSeeder::class);
        $this->call(AnnexRateSeeder::class);
        $this->call(LoadingZoneSeeder::class);
        $this->call(LoadingAreaSeeder::class);
        $this->call(LDMSeeder::class);
        $this->call(PickupCostSeeder::class);
        $this->call(UnloadingZoneSeeder::class);
        $this->call(UnloadingAreaSeeder::class);
        $this->call(RomaniaPickupCostSeeder::class);
        $this->call(UnloadingPriceSeeder::class);
    }
}
