<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class settingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'email' => 'skillshub@gmail.com',
            'phone' => '01000010001',
            'facebook' => 'www.facebook.com',
            'twitter' => 'www.twitter.com',
            'instgram' => 'www.instgram.com',
            'youtube' => 'www.youtube.com',
            'linkedin' => 'www.linkedin.com',

        ]);
    }
}
