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

    <form id="purchase-form">
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        
        <label for="quantity">数量:</label>
        <input type="number" name="quantity" id="quantity" min="1" value="1">

        <button type="submit">購入</button>
    </form>

    <br>

    <button type="button"><a href="{{ route('products.edit', $product->id) }}">編集</a></button>
    <button type="button"><a href="{{ route('products.index') }}">戻る</a></button>
</div>
@endsection

{{-- ✅ スクリプトは専用セクションに --}}
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $('#purchase-form').on('submit', function (e) {
    e.preventDefault();

    const productId = $('input[name="product_id"]').val();
   

    $.ajax({
      url: 'api/sales',
      method: 'POST',
      data: {
        product_id: productId,
        
      },
      success: function (response) {
        alert('購入成功: ' + response.message);
        location.reload();
      },
      error: function (xhr) {
        if (xhr.status === 400 || xhr.status === 422) {
          alert('エラー: ' + (xhr.responseJSON.message || '入力エラー'));
        } else {
          alert('通信エラー: サーバーと接続できません');
        }
      }
    });
  });
</script>
@endsection
