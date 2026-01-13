<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    /**
     * Seed aktivitas rekomendasi.
     */
    public function run(): void
    {
        $activities = [
            [
                'name' => 'Meditasi singkat',
                'description' => 'Lakukan meditasi 5 menit untuk menenangkan pikiran.',
                'duration' => '5 mnt',
            ],
            [
                'name' => 'Jalan kaki ringan',
                'description' => 'Jalan santai 10 menit di sekitar rumah.',
                'duration' => '10 mnt',
            ],
            [
                'name' => 'Menulis jurnal',
                'description' => 'Tuliskan perasaan dan pikiran selama 10 menit.',
                'duration' => '10 mnt',
            ],
            [
                'name' => 'Stretching ringan',
                'description' => 'Gerakan peregangan otot sederhana selama 5 menit.',
                'duration' => '5 mnt',
            ],
        ];

        foreach ($activities as $act) {
            Activity::create($act);
        }
    }
}
