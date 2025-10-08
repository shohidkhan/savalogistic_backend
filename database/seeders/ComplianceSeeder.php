<?php

namespace Database\Seeders;

use App\Models\Compliance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplianceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Compliance::insert([
            [
                'title'=>"Regulation (EC) No 561/2006 - Driver's Hours",
                'description'=>"<h3>Who It Applies To</h3><ul><li>Drivers of vehicles over 3.5 tonnes (goods)</li><li>Drivers of passenger vehicles with more than 9 seats</li><li>Applies in EU, EEA, and Switzerland</li></ul><h3>Main Driving Time Rules</h3><ul><li>Daily Driving: Max 9 hours (10 hours max 2x/week).</li><li>Weekly Driving: Max 56 hours.</li><li>2-Week Driving Limit: Max 90 hours in any 2 consecutive weeks.</li></ul><h3>Rest Period Rules</h3><ul><li>Split Daily Rest: 3 + 9 hours.</li><li>Daily Rest: 11 hours (or 9 hours max 3x/week).</li><li>Weekly Rest: 45 hours (can reduce to 24 hours every other week).</li><li>Compensation: Reduced rest must be compensated later.</li></ul><h3>Breaks During Driving</h3><ul><li>Can split break: 15 minutes + 30 minutes.</li><li>After 4.5 hours of driving: 45-minute break required.</li></ul><h3>Working Week Rules (Directive 2002/15/EC)</h3><ul><li>Average Weekly Working Time: Max 48 hours.</li><li>Average Weekly Working Time: Max 48 hours.</li></ul><h3>Tachograph Requirement</h3><p>Must use digital/analog tachograph to record:</p><ul><li>Driving time</li><li>Rest and breaks</li></ul><h3>Penalties for Violation</h3><ul><li>Country-specific fines (EUR 100-5,000+).</li></ul>"
            ],
            [
                'title'=>"Directive 2002/15/EC - Working Time",
                'description'=>"<h3>Who It Applies To</h3><ul><li>Drivers of vehicles over 3.5 tonnes (goods)</li><li>Drivers of passenger vehicles with more than 9 seats</li><li>Applies in EU, EEA, and Switzerland</li></ul><h3>Main Driving Time Rules</h3><ul><li>Daily Driving: Max 9 hours (10 hours max 2x/week).</li><li>Weekly Driving: Max 56 hours.</li><li>2-Week Driving Limit: Max 90 hours in any 2 consecutive weeks.</li></ul><h3>Rest Period Rules</h3><ul><li>Split Daily Rest: 3 + 9 hours.</li><li>Daily Rest: 11 hours (or 9 hours max 3x/week).</li><li>Weekly Rest: 45 hours (can reduce to 24 hours every other week).</li><li>Compensation: Reduced rest must be compensated later.</li></ul><h3>Breaks During Driving</h3><ul><li>Can split break: 15 minutes + 30 minutes.</li><li>After 4.5 hours of driving: 45-minute break required.</li></ul><h3>Working Week Rules (Directive 2002/15/EC)</h3><ul><li>Average Weekly Working Time: Max 48 hours.</li><li>Average Weekly Working Time: Max 48 hours.</li></ul><h3>Tachograph Requirement</h3><p>Must use digital/analog tachograph to record:</p><ul><li>Driving time</li><li>Rest and breaks</li></ul><h3>Penalties for Violation</h3><ul><li>Country-specific fines (EUR 100-5,000+).</li></ul>"
            ],
        ]);
    }
}
