<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- tablesorter CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/css/theme.default.min.css">

    <!-- tablesorter JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>

    <script>
  $(document).ready(function () {
    const $table = $("#product-table");

    // tablesorter（一覧ページのみ）
    if ($table.length > 0 && typeof $table.tablesorter === 'function') {
      $table.tablesorter({
        sortList: [[0, 1]],
        headers: {
          1: { sorter: false },
          6: { sorter: false },
          7: { sorter: false },
        }
      });
    }

    // ✅ 検索フォーム Ajax送信（ここに入れる）
    $('#search-form').on('submit', function (e) {
      e.preventDefault();
      $.ajax({
        url: "{{ route('products.index') }}",
        type: "GET",
        data: $(this).serialize(),
        dataType: "html",
        success: function (response) {
          const newBody = $(response).find("table tbody").html();
          $("table tbody").html(newBody);
          $("#product-table").trigger("update");
        },
        error: function () {
          alert("検索に失敗しました");
        }
      });
    });

    // ✅ 削除ボタン Ajax（これもここに入れてOK）
    $(document).on('click', '.delete-button', function () {
      if (!confirm('本当に削除しますか？')) return;

      const productId = $(this).data('id');

      $.ajax({
        url: `products/${productId}`,
        type: 'POST',
        data: {
          _method: 'DELETE',
          _token: '{{ csrf_token() }}'
        },
        success: function (response) {
          alert('削除成功');
          location.reload();
        },
        error: function (xhr, status, error) {
          console.error('削除失敗:', error);
          console.log('レスポンス内容:', xhr.responseText);
          alert('削除に失敗しました');
        }
      });
    });
  });
</script>

</head>
@yield('scripts')
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>