@extends('layouts.app')

@section('content')
<h1>会社詳細</h1>

<p><strong>ID:</strong> {{ $company->id }}</p>
<p><strong>会社名:</strong> {{ $company->company_name }}</p>
<p><strong>住所:</strong> {{ $company->street_address }}</p>
<p><strong>代表者名:</strong> {{ $company->representative_name }}</p>
<p><strong>登録日時:</strong> {{ $company->created_at }}</p>
<p><strong>更新日時:</strong> {{ $company->updated_at }}</p>

<a href="{{ route('companies.edit', $company->id) }}"> <button type="button">編集</button></a>



    <a href="{{ route('companies.index') }}">
        <button type="button">一覧に戻る</button>
    </a>
</div>
@endsection
