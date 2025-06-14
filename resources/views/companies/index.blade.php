@extends('layouts.app')

@section('content')
<h1>会社一覧</h1>

<button type="submit"><a href="{{ route('companies.create') }}">新規登録</a></button>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>会社名</th>
            <th>住所</th>
            <th>代表者名</th>
            <th>詳細</th>
            <th>編集</th>
            <th>削除</th>
        </tr>
    </thead>
    <tbody>
        @foreach($companies as $company)
        <tr>
            <td>{{ $company->id }}</td>
            <td>{{ $company->company_name }}</td>
            <td>{{ $company->street_address }}</td>
            <td>{{ $company->representative_name }}</td>
            <td><button type="submit"><a href="{{ route('companies.show', $company->id) }}">詳細</a></button></td>
            <td><button type="submit"><a href="{{ route('companies.edit', $company->id) }}">編集</a></button></td>
            <td>
                <form action="{{ route('companies.destroy', $company->id) }}" method="POST">
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
