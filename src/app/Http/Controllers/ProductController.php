<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 商品一覧表示
    public function index(Request $request)
    {
        $query = Product::query();

        // 検索処理
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // 並び替え処理
        $validSorts = ['price_asc', 'price_desc'];
        if ($request->filled('sort') && in_array($request->sort, $validSorts)) {
            if ($request->sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        }

        $products = $query->paginate(6)->appends($request->all());

        return view('products.index', compact('products'));
    }

    // 商品登録画面
    public function create()
    {
        $seasons = Season::all();
        return view('products.create', compact('seasons'));
    }

    // 商品登録処理
    public function store(StoreProductRequest $request)
    {
        // 画像アップロード
        $path = $request->file('image')->store('products', 'public');

        // 商品登録
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
        ]);

        // 季節の関連付け
        if ($request->filled('season_id')) {
            $product->seasons()->sync($request->season_id);
        }

        return redirect()->route('products.show', ['product' => $product->id])
            ->with('success', '商品を登録しました');
    }

    // 商品編集画面
    public function edit(Product $product)
    {
        $seasons = Season::all();
        return view('products.edit', compact('product', 'seasons'));
    }

    // 商品更新処理
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->only(['name', 'price', 'description']);

        // 画像がアップロードされた場合
        if ($request->hasFile('image')) {
            // 古い画像を削除
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }

            // 新画像を保存
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        // 商品情報を更新
        $product->update($data);

        // 季節の関連付け
        if ($request->filled('season_id')) {
            $product->seasons()->sync($request->season_id);
        } else {
            $product->seasons()->detach();
        }

        return redirect()->route('products.show', ['product' => $product->id])
            ->with('success', '商品情報を更新しました');
    }

    // 商品削除
    public function destroy(Product $product)
    {
        // 画像を削除
        if ($product->image && Storage::exists('public/' . $product->image)) {
            Storage::delete('public/' . $product->image);
        }

        // 季節の関連を削除
        $product->seasons()->detach();

        // 商品を削除
        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました');
    }

    // 商品詳細表示
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}