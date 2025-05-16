@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
    <div class="product-wrapper">
        <h1>商品登録</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- 商品名 -->
            <div class="product-name-field">
                <label class="field-title">
                    商品名 <span class="required">必須</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="商品名を入力">
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- 値段 -->
            <div class="product-price-field">
                <label class="field-title">
                    値段 <span class="required">必須</span>
                </label>
                <input type="text" name="price" value="{{ old('price') }}" placeholder="値段を入力">
                @error('price')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- 季節 -->
            <div class="product-seasons-field">
                <label class="field-title">
                    季節 <span class="required">必須</span><span class="multiple">（複数選択可）</span>
                </label>
                <div class="season-options">
                    @foreach ($seasons as $season)
                        <label class="season-label">
                            <input type="checkbox" name="season_id[]" value="{{ $season->id }}" {{ is_array(old('season_id')) && in_array($season->id, old('season_id')) ? 'checked' : '' }}>
                            {{ $season->name }}
                        </label>
                    @endforeach
                </div>
                @error('season_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- 商品画像 -->
            <div class="product-image-field">
                <label class="field-title">
                    商品画像 <span class="required">必須</span>
                </label>
                <input type="file" name="image">
                @error('image')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>


            <!-- 商品説明 -->
            <div class="product-description-field">
                <label class="field-title">
                    商品説明 <span class="required">必須</span>
                </label>
                <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                @error('description')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <!-- ボタン -->
            <div class="form-buttons">
                <button type="submit">登録</button>
                <a href="{{ route('products.index') }}" class="back-button">戻る</a>
            </div>
        </form>
    </div>
@endsection