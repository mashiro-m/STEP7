@extends('layouts.app')

@section('content')
<div class="container">
    <h1>商品情報編集画面</h1>

    {{-- エラーメッセージ表示 --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="product_name">商品名</label><span style="color:red;">※</span><br>
            <input type="text" id="product_name" name="product_name" value="{{ old('product_name', $product->product_name) }}" >
        </div>

        <div>
            <label for="company_id">メーカー</label><span style="color:red;">※</span><br>
            <select id="company_id" name="company_id" >
                <option value="">選択してください</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id', $product->company_id) == $company->id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="price">価格</label><span style="color:red;">※</span><br>
            <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" >
        </div>

        <div>
            <label for="stock">在庫数</label><span style="color:red;">※</span><br>
            <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" >
        </div>

        <div>
            <label for="comment">コメント</label><br>
            <textarea id="comment" name="comment">{{ old('comment', $product->comment) }}</textarea>
        </div>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div>
        <label>商品画像：</label><br>
        <input type="file" name="img_path">
        @if ($product->img_path)
            <br>
            <img src="{{ asset('storage/' . $product->img_path) }}" width="100">
        @endif
    </div>

    <br>
    <button type="submit">更新</button>
    <button type="submit"><a href="{{ route('products.index') }}">一覧に戻る</a></button>
</form>

</div>
@endsection
