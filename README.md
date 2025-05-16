## mogitare
## 使用技術
- Laravel Framework 8.83.29
- PHP 7.4.9
- Composer version 2.8.8
- mysql  Ver 15.1
- Docker version 28.0.1
# 言語
- PHP（バックエンド）
- Blade（テンプレートエンジン）
- HTML / CSS（マークアップ、スタイリング）
- JavaScript（フロントエンド）
- MySQL (データベース)
- SQL (データ操作言語)
## ER図
[products]                [seasons]             [season_product]
------------              ------------          ---------------------
id (PK)                   id (PK)               id (PK)
name                     name                  product_id (FK)
description              created_at            season_id (FK)
price                    updated_at            created_at
image_path                                      updated_at
created_at
updated_at
# テーブル仕様書
![productsテーブル](images/test1.png)
![seasonsテーブル](images/test2.png)
![product_seasonテーブル(](images/test3.png)
##　セットアップ
# ルーティング情報
商品一覧
- /products
商品詳細
- /products/{productId}
商品更新
- /products/{productId}/update
商品登録
- /products/register
検索
- /products/search
削除
- /products/search
# リポジトリをクローン
- git@github.com:matsue1157/mogitate.git
# ドッカーbuild
- docker-compose up -d --build
# パッケージインストール
- docker-compose exec php bash
- composer install
# envファイルの作成
- cp .env.example .env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
# マイグレーション
- php artisan make:migration create_products_table
- php artisan make:migration create_seasons_table
- php artisan make:migration create_product_season_table
- php artisan make:migration remove_season_id_from_products_table
# マイグレーションの実行
- php artisan migrate
# seeder
- php artisan make:seeder ProductSeeder
- php artisan make:seeder SeasonSeeder
# シーディング
- php artisan migrate:fresh --seed
# models
- php artisan make:model Product
- php artisan make:model Season
## URL
- 商品一覧
- http://localhost/products
- 商品登録
- http://localhost/products/create
