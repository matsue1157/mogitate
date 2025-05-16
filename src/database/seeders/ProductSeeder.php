<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Models\Season;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'キウイ',
                'price' => 800,
                'description' => 'キウイは甘みと酸味のバランスが絶妙なフルーツです。ビタミンCなどの栄養素も豊富のため、美肌効果や疲労回復効果も期待できます。もぎたてフルーツのスムージーをお召し上がりください！',
                'image' => 'kiwi.png',
                'seasons' => ['秋', '冬'],
            ],
            [
                'name' => 'ストロベリー',
                'price' => 1200,
                'description' => '大人から子供まで大人気のストロベリー。当店では鮮度抜群の完熟いちごを使用しています。',
                'image' => 'strawberry.png',
                'seasons' => ['春'],
            ],
            [
                'name' => 'オレンジ',
                'price' => 850,
                'description' => '酸味と甘みのバランスが抜群のネーブルオレンジを使用しています。',
                'image' => 'orange.png',
                'seasons' => ['冬'],
            ],
            [
                'name' => 'スイカ',
                'price' => 700,
                'description' => '甘くてシャリシャリ食感が魅力のスイカ。全体の90％が水分で暑い日におすすめです。',
                'image' => 'watermelon.png',
                'seasons' => ['夏'],
            ],
            [
                'name' => 'ピーチ',
                'price' => 1000,
                'description' => 'とろけるような甘さが魅力のピーチ。見た目の可愛さも抜群。',
                'image' => 'peach.png',
                'seasons' => ['夏'],
            ],
            [
                'name' => 'シャインマスカット',
                'price' => 1400,
                'description' => '爽やかな香りと上品な甘みのシャインマスカット。',
                'image' => 'muscat.png',
                'seasons' => ['夏', '秋'],
            ],
            [
                'name' => 'パイナップル',
                'price' => 800,
                'description' => '甘酸っぱさとトロピカルな香りが特徴の国産パイナップル。',
                'image' => 'pineapple.png',
                'seasons' => ['春', '夏'],
            ],
            [
                'name' => 'ブドウ',
                'price' => 1100,
                'description' => '高い糖度と酸味が魅力の国産「巨峰」を使用。',
                'image' => 'grape.png',
                'seasons' => ['夏', '秋'],
            ],
            [
                'name' => 'バナナ',
                'price' => 600,
                'description' => '低カロリーで栄養満点。バナナの濃厚な甘みを堪能。',
                'image' => 'banana.png',
                'seasons' => ['夏'],
            ],
            [
                'name' => 'メロン',
                'price' => 900,
                'description' => '香りがよくジューシーで甘さが人気のメロン。',
                'image' => 'melon.png',
                'seasons' => ['春', '夏'],
            ],
        ];

        foreach ($products as $data) {
            // 元画像パス（publicディレクトリ内の画像）
            $sourcePath = public_path('fruits-img/' . $data['image']);

            // 保存先パス（storageディレクトリに保存）
            $storagePath = 'products/' . $data['image'];

            // ファイルをstorageにコピー（既に存在している場合は上書き）
            if (File::exists($sourcePath)) {
                Storage::disk('public')->put($storagePath, File::get($sourcePath));
            }

            // 商品登録
            $product = Product::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'description' => $data['description'],
                'image' => $storagePath,
            ]);

            // 季節を関連付け
            $seasonIds = Season::whereIn('name', $data['seasons'])->pluck('id')->toArray();
            $product->seasons()->attach($seasonIds);
        }
    }
}