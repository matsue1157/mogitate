@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="container">

    <div class="breadcrumb mb-3">
        <a href="{{ route('products.index') }}">商品一覧</a> &gt;
        <span>{{ $product->name }}</span>
    </div>

    <h2>商品編集</h2>

    {{-- 編集フォーム --}}
    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- 商品名 --}}
        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- 値段 --}}
        <div class="form-group">
            <label for="price">値段</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}">
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- 季節 --}}
        <div class="form-group">
            <label>季節</label><br>
            @php
                $seasons = \App\Models\Season::all();
                $selectedSeasons = old('season_id', $product->seasons->pluck('id')->toArray());
            @endphp
            <div class="d-flex flex-wrap gap-3">
                @foreach($seasons as $season)
                    <div class="form-check mr-3">
                        <input class="form-check-input" type="checkbox" name="season_id[]" value="{{ $season->id }}"
                            {{ in_array($season->id, $selectedSeasons) ? 'checked' : '' }}>
                        <label class="form-check-label">{{ $season->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- 商品画像 --}}
        <div class="form-group">
            <label for="image">商品画像</label><br>
            {{-- ここで現在の画像を表示 --}}
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="商品画像" style="width:150px; margin-bottom:10px;">
            @else
                <p>画像はまだアップロードされていません</p>
            @endif
            <input type="file" name="image" class="form-control">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- 商品説明 --}}
        <div class="form-group">
            <label for="description">商品説明</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- 保存・戻るボタン --}}
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary">変更を保存</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
        </div>
    </form>

    {{-- 削除ボタン --}}
    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="position-absolute"
        style="right: 20px; bottom: 20px;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">
            🗑️ 削除
        </button>
    </form>

</div>
@endsection