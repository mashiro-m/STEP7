@extends('layouts.app')

@section('content')
    <h1>商品一覧</h1>

    <form id="search-form" method="GET" action="{{ route('products.index') }}">
        <input type="text" name="product_name" placeholder="商品名">

        <select name="company_id">
            <option value="">--メーカーを選択--</option>
            @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
            @endforeach
        </select>

        <input type="number" name="price_min" placeholder="価格（下限）">
        <input type="number" name="price_max" placeholder="価格（上限）">
        <input type="number" name="stock_min" placeholder="在庫（下限）">
        <input type="number" name="stock_max" placeholder="在庫（上限）">

        <button type="submit">検索</button>
    </form>

    <p>
        <a href="{{ route('products.create') }}">
            <button type="button">新規登録</button>
        </a>
    </p>

    <table id="product-table" class="tablesorter">
        <thead>
            <tr>
                <th>ID</th>
                <th>画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー</th>
                <th>詳細</th>
                <th>削除</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @if($product->img_path)
                            <img src="{{ asset('storage/' . $product->img_path) }}" width="80">
                        @else
                            画像なし
                        @endif
                    </td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->price }}円</td>
                    <td>{{ $product->stock }}個</td>
                    <td>{{ $product->company->company_name ?? '未設定' }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}">
                            <button type="button">詳細</button>
                        </a>
                    </td>
                    <td>
                        <button class="delete-button" data-id="{{ $product->id }}">削除</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
   
@endsection