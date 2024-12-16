<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todo</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DotGothic16&family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">
  @yield('css')
</head>

<body>
    <nav>
        <ul>
            <li>
              <a href="/my" action="/myindex">mypage</a>
            </li>
            <li>
              <a href="">logout</a>
            </li>
        </ul>   
    </nav>
    <header class="header">
    <div class="header-logo">
      <a class="header-logo__inner" href="/" action="/">
            Schedule & Todo
      </a>
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>

</html>
