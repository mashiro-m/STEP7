@extends('layouts.app')

@section('content')
<div class="container">
    <h1>商品情報詳細画面</h1>

    <p><strong>ID:</strong> {{ $product->id }}</p>
    <p><strong>商品名:</strong> {{ $product->product_name }}</p>
    <p><strong>メーカー:</strong> {{ $product->company->company_name }}</p>
    <p><strong>価格:</strong> {{ $product->price }} 円</p>
    <p><strong>在庫数:</strong> {{ $product->stock }} 個</p>
    <p><strong>コメント</strong> {{ $product->comment }}</p>
    <p><strong>商品画像</strong> {{ $product->img_path }}</p>
    
    <button type="submit"><a href="{{ route('products.edit', $product->id) }}">編集</a></button>
    <button type="submit"><a href="{{ route('products.index') }}">戻る</a></button>
</div>
@endsection
