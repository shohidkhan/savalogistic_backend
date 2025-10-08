<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Certificate::insert([
            [
                'title'=>'ISO 9001 Certification',
                'issued_by'=>'Issued by: International Organization for Standardization',
                'is_verified' => 1,
                'image'=> '/backend/images/cert.png',
            ],
            [
                'title'=>'ADR Certificate',
                'issued_by'=>'Issued by: European Agreement for Transport of Hazardous Goods',
                'is_verified' => 1,
                'image'=> '/backend/images/cert.png',
            ],
            [
                'title'=>'UECE Membership',
                'issued_by'=>'Issued by: Issued by: United European Courier Express',
                'is_verified' => 1,
                'image'=> '/backend/images/cet1.png',
            ],
            [
                'title'=>'EORI Registration',
                'issued_by'=>'Issued by: Issued by: United European Courier Express',
                'is_verified' => 1,
                'image'=> '/backend/images/cet1.png',
            ],
        ]);
    }
}
