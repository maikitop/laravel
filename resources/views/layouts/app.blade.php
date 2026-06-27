<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Нарушением.Нет</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- стили -->
</head>

<body>
    <!-- шапка сайта -->
    <header>
        <div class="header-container">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Логотип">
            </a>
            <nav>
                <a href="{{ route('home') }}">Главная</a>

                @guest
                <a href="{{ route('login') }}">Вход</a>
                <a href="{{ route('register') }}">Регистрация</a>
                @endguest

                @auth
                @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.index') }}">Панель администратора</a>
                @else
                <a href="{{ route('reports.create') }}">Создать заявление</a>
                <a href="{{ route('reports.index') }}">Мои заявки</a>
                @endif
                <a href="{{ route('logout') }}">Выход ({{ auth()->user()->login }})</a>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>Мы помогаем. На данный момент количество решённых проблем: <span id="resolved-counter">{{ $resolvedCount ?? 0 }}</span></p>
    </footer>

    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>