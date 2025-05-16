<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// トップページを /products にリダイレクト
Route::get('/', function () {
    return redirect()->route('products.index');
});

// 商品に関する個別ルート
Route::prefix('products')->name('products.')->group(function () {
    // 商品一覧
    Route::get('/', [ProductController::class, 'index'])->name('index');

    // 商品登録ページ
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('/', [ProductController::class, 'store'])->name('store');

    // 商品詳細ページ
    Route::get('{product}', [ProductController::class, 'show'])->name('show');

    Route::put('{product}', [ProductController::class, 'update'])->name('update');

    // 商品削除
    Route::delete('{product}', [ProductController::class, 'destroy'])->name('destroy');
});

// 商品編集ページ（GET）
Route::get('{product}/edit', [ProductController::class, 'edit'])->name('edit');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');