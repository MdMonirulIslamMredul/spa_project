<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Deactivate old placeholder videos
        DB::table('videos')->where('is_active', 1)->update(['is_active' => 0]);

        $videos = [
            [
                'video_title' => 'Traditional Thai Massage Therapy & Acupressure',
                'video_url' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/Dd1rOa4GUgY" title="Traditional Thai Massage Therapy & Acupressure" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'video_title' => 'Aromatherapy & Herbal Essential Oil Ritual',
                'video_url' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/V5w1OGSk_lc" title="Aromatherapy & Herbal Essential Oil Ritual" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'video_title' => 'Deep Tissue & Warm Herbal Compress Relief',
                'video_url' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/wT3kR13Vb4A" title="Deep Tissue & Warm Herbal Compress Relief" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'video_title' => 'Head, Neck & Shoulder Stress Release',
                'video_url' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/8UVNT4wvIGY" title="Head, Neck & Shoulder Stress Release" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
                'is_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('videos')->insert($videos);
    }
}
