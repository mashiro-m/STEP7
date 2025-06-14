@extends('layouts.app')

@section('content')
<h1>会社情報編集</h1>

<form action="{{ route('companies.update', $company->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>会社名:</label>
    <input type="text" name="company_name" value="{{ $company->company_name }}" required><br>

    <label>住所:</label>
    <input type="text" name="street_address" value="{{ $company->street_address }}" required><br>

    <label>代表者名:</label>
    <input type="text" name="representative_name" value="{{ $company->representative_name }}" required><br>

    <button type="submit">更新</button>
    <button type="submit"><a href="{{ route('companies.index') }}">一覧に戻る</a></button>

</form>
@endsection
