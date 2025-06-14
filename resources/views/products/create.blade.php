@extends('layouts.app')

@section('content')
<div class="container">
    <h1>商品新規登録</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <p><div>
            {!! '<label for="product_name">商品名 <span style="color:red;">※</span>：</label>' !!}
            <input type="text" id="product_name" name="product_name" value="{{ old('product_name') }}" required>
        </div></p>

        <p><div>
            {!! '<label for="company_id">メーカー <span style="color:red;">※</span>：</label>' !!}
            <select id="company_id" name="company_id" required>
                <option value="">選択してください</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div></p>

        <p><div>
            {!! '<label for="price">価格 <span style="color:red;">※</span>：</label>' !!}
            <input type="number" id="price" name="price" value="{{ old('price') }}" required>
        </div></p>

        <p><div>
            {!! '<label for="stock">在庫数 <span style="color:red;">※</span>：</label>' !!}
            <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required>
        </div></p>

        <p><div>
            <label for="comment">商品説明：</label>
            <textarea id="comment" name="comment">{{ old('comment') }}</textarea>
        </div></p>

        <p><div>
            <label for="img_path">商品画像：</label>
            <input type="file" id="img_path" name="img_path">
        </div></p>

        <br>
        <button type="submit">新規登録</button>
        <button type="submit"><a href="{{ route('products.index') }}">一覧に戻る</a></button>
    </form>
</div>
@endsection
