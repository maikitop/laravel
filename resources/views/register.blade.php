<!-- resources/views/register.blade.php -->
@extends('layouts.app')

@section('content')
<!-- Форма регистрации -->
<div class="form-container">
    <h2 style="margin-bottom: 20px;">Регистрация</h2>

    <!-- id формы для JS валидации -->
    <form method="POST" action="{{ route('register') }}" id="register-form">
        @csrf

        <div class="form-group">
            <label for="fio">ФИО:</label>
            <input type="text" id="fio" name="fio" value="{{ old('fio') }}" required placeholder="Иванов Иван Иванович">
            @error('fio') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="login">Логин (латиница и цифры, от 4 символов):</label>
            <input type="text" id="login" name="login" value="{{ old('login') }}" required placeholder="user123">
            @error('login') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="example@mail.ru">
            @error('email') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="phone">Телефон:</label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="+7(999)123-45-67">
            @error('phone') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Пароль (минимум 6 символов):</label>
            <input type="password" id="password" name="password" required placeholder="Придумайте пароль">
            @error('password') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn">Зарегистрироваться</button>
    </form>

    <!-- Ссылка на авторизацию -->
    <p style="margin-top: 20px; text-align: center;">
        <a href="{{ route('login') }}" style="color: var(--primary-color);">Есть профиль? Авторизоваться.</a>
    </p>
</div>
@endsection