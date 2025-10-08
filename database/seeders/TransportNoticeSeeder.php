<?php

namespace Database\Seeders;

use App\Models\TransportNotice;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransportNoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransportNotice::insert([
            [
                'title'=>'Ley 15/2009 – Contract of Land Transport of Goods',
                'sub_title'=>'Defines conditions for goods transport contracts',
                'code'=>'BOE-A-200918004',
                'file'=>'/frontend/transport_notice.pdf',
                'date'=>Carbon::now()->format('Y-m-d'),
                'created_at'=>now(),
            ],
            [
                'title'=>'Ley 37/2015 – Road Transport Infrastructure Law',
                'sub_title'=>'Regulates road infrastructure and planning',
                'code'=>'BOE-A-200918004345',
                'file'=>'/frontend/transport_notice.pdf',
                'date'=>Carbon::now()->format('Y-m-d'),
                'created_at'=>now(),
            ],
            [
                'title'=>'Real Decreto 2822/1998 – General Vehicle Regulation',
                'sub_title'=>'Technical and safety standards for vehicles',
                'code'=>'BOE-A-2009180043454354',
                'file'=>'/frontend/transport_notice.pdf',
                'date'=>Carbon::now()->format('Y-m-d'),
                'created_at'=>now(),
            ],
            [
                'title'=>'Real Decreto 1737/2010 – Transport Control Document Regulation',
                'sub_title'=>'Regulates control documents in road transport',
                'code'=>'BOE-A-20091800434536',
                'file'=>'/frontend/transport_notice.pdf',
                'date'=>Carbon::now()->format('Y-m-d'),
                'created_at'=>now(),
            ],
        ]);
    }
}
