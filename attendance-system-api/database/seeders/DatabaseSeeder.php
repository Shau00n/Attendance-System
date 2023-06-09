<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Calendar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ユーザーテーブルにデータを追加
        User::factory()->count(3)->create();

        // カレンダーテーブルにデータを追加
        Calendar::insert([
            [
                'date' => '2023-04-01',
                'is_holiday' => true,
                'holiday_name' => '春の日'
            ],
            // ...（省略）...
            [
                'date' => '2023-04-30',
                'is_holiday' => false,
                'holiday_name' => null
            ]
        ]);

        // 勤怠記録テーブルにデータを追加
        $users = User::all();
        foreach ($users as $user) {
            Attendance::factory()->count(10)->create([
                'user_id' => $user->id,
                'clock_in' => now()->setTime(rand(6, 9), rand(0, 59), rand(0, 59)),
                'clock_out' => now()->setTime(rand(17, 23), rand(0, 59), rand(0, 59)),
            ]);
        }
    }
}
