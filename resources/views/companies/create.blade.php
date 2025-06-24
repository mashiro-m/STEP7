@extends('layouts.app')

@section('content')
<div class="container">
    <h1>会社新規登録</h1>

    {{-- バリデーションエラー表示 --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 登録フォーム --}}
    <form action="{{ route('companies.store') }}" method="POST">
        @csrf

        <div>
            <label for="company_name">会社名<span style="color: red;">※</span>：</label><br>
            <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}" >
        </div>

        <div>
            <label for="street_address">住所<span style="color: red;">※</span>：</label><br>
            <input type="text" id="street_address" name="street_address" value="{{ old('street_address') }}" >
        </div>

        <div>
            <label for="representative_name">代表者名<span style="color: red;">※</span>：</label><br>
            <input type="text" id="representative_name" name="representative_name" value="{{ old('representative_name') }}">
        </div>

        <br>
        <button type="submit">登録</button>
        <button type="submit"><a href="{{ route('companies.index') }}">一覧に戻る</a></button>
    </form>
</div>
@endsection
