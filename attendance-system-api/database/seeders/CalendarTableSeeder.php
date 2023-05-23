<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalendarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // 2023年の祝日を配列で定義
        $holidays = [
            '2023-01-01' => '元日',
            '2023-01-02' => '振替休日',
            '2023-01-09' => '成人の日',
            '2023-02-11' => '建国記念の日',
            '2023-02-23' => '天皇誕生日',
            '2023-03-21' => '春分の日',
            '2023-04-29' => '昭和の日',
            '2023-05-03' => '憲法記念日',
            '2023-05-04' => 'みどりの日',
            '2023-05-05' => 'こどもの日',
            '2023-07-17' => '海の日',
            '2023-08-11' => '山の日',
            '2023-09-18' => '敬老の日',
            '2023-09-23' => '秋分の日',
            '2023-10-09' => 'スポーツの日',
            '2023-11-03' => '文化の日',
            '2023-11-23' => '勤労感謝の日'
        ];

        // 2023年1月1日から12月31日までの日付をループ
        $date = new DateTime('2023-01-01');
        while ($date->format('Y') === '2023') {
            // 日付を文字列に変換
            $dateStr = $date->format('Y-m-d');
            
            // 祝日名を取得（なければnull）
            $holidayName = $holidays[$dateStr] ?? null;

            // 祝日かどうかを判定（祝日名があればtrue）
            $isHoliday = $holidayName ? true : false;

            // カレンダーテーブルにレコードを挿入
            DB::table('calendars')->insert([
                'date' => $dateStr,
                'is_holiday' => $isHoliday,
                'holiday_name' => $holidayName,
            ]);

            // 日付を1日進める
            $date->modify('+1 day');
        }
    }
}