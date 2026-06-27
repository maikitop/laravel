<!-- resources/views/login.blade.php -->
@extends('layouts.app')

@section('content')
<!-- Форма авторизации -->
<div class="form-container">
    <h2 style="margin-bottom: 20px;">Авторизация</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="login">Логин:</label>
            <input type="text" id="login" name="login" value="{{ old('login') }}" required placeholder="Введите ваш логин">
            @error('login') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required placeholder="Введите ваш пароль">
            @error('password') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn">Авторизация</button>
    </form>

    <!-- Ссылка на регистрацию -->
    <p style="margin-top: 20px; text-align: center;">
        <a href="{{ route('register') }}" style="color: var(--primary-color);">Нет профиля? Зарегистрироваться.</a>
    </p>
</div>
@endsection