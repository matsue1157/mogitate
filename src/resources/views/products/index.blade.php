@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <!-- 全体を囲むラッパークラス -->
    <div class="product-wrapper">

        <div class="product-index__header">
            <h1 class="product-index__title">商品一覧</h1>
            <div class="product-index__add-button">
                <a href="{{ route('products.create') }}" class="button-add">＋ 商品を追加</a>
            </div>
        </div>

        {{-- 検索フォーム --}}
        <div class="product-index__main">
            <div class="product-index__sidebar">
                <form class="product-index__search-form" method="GET" action="{{ route('products.index') }}">
                    <input type="text" name="keyword" class="product-index__search-input" placeholder="商品名で検索"
                        value="{{ request('keyword') }}">
                    <button type="submit" class="product-index__search-button">検索</button>
                </form>

                {{-- 並び替えフォーム --}}
                <form action="{{ route('products.index') }}" method="GET" class="product-index__sort-form">
                    <select name="sort" onchange="this.form.submit()">
                        <option value="">並び替え</option>
                        <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>価格が低い順</option>
                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>価格が高い順</option>
                    </select>
                </form>

                {{-- 並び替え条件表示 --}}
                @if(request('sort'))
                    <div class="product-index__tag">
                        並び替え:
                        <span class="tag">
                            @if(request('sort') === 'price_asc') 価格が低い順
                            @elseif(request('sort') === 'price_desc') 価格が高い順
                            @endif
                            <a href="{{ route('products.index') }}" class="tag__remove">×</a>
                        </span>
                    </div>
                @endif

                {{-- 商品カード表示 --}}
                <div class="product-index__cards">
                    @foreach ($products as $product)
                        <div class="product-card">
                            @if ($product->image)
    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-card__image">
@else
    <img src="{{ asset('images/no-image.png') }}" alt="No image available" class="product-card__image">
@endif

                            <div class="product-card__content">
                                <h3 class="product-card__name">{{ $product->name }}</h3>
                                <p class="product-card__price">¥{{ number_format($product->price) }}</p>
                                <a href="{{ route('products.show', ['product' => $product->id]) }}"
                                    class="product-card__detail-button">詳細</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- ページネーション --}}
                <div class="pagination">
                    {{ $products->appends(request()->query())->links() }}
                </div>

            </div> {{-- .product-index__sidebar --}}
        </div> {{-- .product-index__main --}}
    </div> {{-- .product-wrapper --}}
@endsection