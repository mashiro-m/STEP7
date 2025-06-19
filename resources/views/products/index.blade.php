@extends('layouts.app')

@section('content')
    <h1>商品一覧</h1>

    <p><form method="GET" action="{{ route('products.index') }}">
    <input type="text" name="product_name" placeholder="商品名" value="{{ request('product_name') }}">

<select name="company_id">
    <option value="">--メーカーを選択--</option>
    @foreach($companies as $company)
        <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>
            {{ $company->company_name }}
        </option>
    @endforeach
</select>

        <button type="submit">検索</button>
    </form></p>

    <table>
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
        <p><button type="submit"><a href="{{ route('products.create') }}">新規登録</a></button></p>
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
                <td> <button type="submit"><a href="{{ route('products.show', $product->id) }}">詳細</a></button></td>
                <td>
                    <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
