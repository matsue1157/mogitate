<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 登録したい季節の名前
        $seasons = ['春', '夏', '秋', '冬'];

        // 季節データを登録または更新（同じ名前のレコードがあれば更新し、なければ作成）
        foreach ($seasons as $name) {
            Season::updateOrCreate(['name' => $name]);
        }
    }
}