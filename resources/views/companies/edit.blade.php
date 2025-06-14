@extends('layouts.app')

@section('content')
<h1>会社情報編集</h1>

<form action="{{ route('companies.update', $company->id) }}" method="POST">
    @csrf
    @method('PUT')

    <p>
        <label>会社名 <span style="color: red;">※</span>:</label>
        <input type="text" name="company_name" value="{{ $company->company_name }}" required>
    </p>

    <p>
        <label>住所 <span style="color: red;">※</span>:</label>
        <input type="text" name="street_address" value="{{ $company->street_address }}" required>
    </p>

    <p>
        <label>代表者名 <span style="color: red;">※</span>:</label>
        <input type="text" name="representative_name" value="{{ $company->representative_name }}" required>
    </p>

    <button type="submit">更新</button>
    <a href="{{ route('companies.index') }}"><button type="button">一覧に戻る</button></a>

</form>
@endsection
