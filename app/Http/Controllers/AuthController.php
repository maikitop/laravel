<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    // Обработка регистрации
    public function register(Request $request)
    {
        // Валидация данных
        $validated = $request->validate([
            // ФИО пробелы дефисы3 слова.
            'fio' => ['required', 'string'],
            // Логин
            'login' => ['required', 'string', 'min:4', 'unique:users'],
            // Email валидный формат, уникальный
            'email' => ['required', 'string', 'email', 'unique:users'],
            // Телефон формат 
            'phone' => ['required', 'string'],
            // Пароль минимум 6 символов
            'password' => ['required', 'string', 'min:6'],
        ], [
            // Сообщения об ошибках
            'fio.regex' => 'ФИО должно состоять ровно из 3 слов на кириллице.',
            'login.regex' => 'Логин должен содержать только латинские буквы и цифры.',
            'login.unique' => 'Такой логин уже занят.',
            'login.min' => 'Логин должен быть не менее 4 символов.',
            'email.email' => 'Введите корректный email адрес.',
            'email.unique' => 'Такой email уже зарегистрирован.',
            'phone.regex' => 'Телефон должен быть в формате +7(XXX)XXX-XX-XX.',
            'password.min' => 'Пароль должен быть не менее 6 символов.',
            'required' => 'Это поле обязательно для заполнения.'
        ]);

        // Хеш пароля
        $validated['password'] = Hash::make($validated['password']);

        // Создание пользователя
        $user = User::create($validated);

        // авторизация
        Auth::login($user);
        return redirect()->route('reports.index');
    }

    // Показать форму входа
    public function showLogin()
    {
        return view('login');
    }

    // Обработка входа
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        // Попытка авторизации
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Если админ - редирект в панель админа, иначе в мои заявки
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.index');
            }
            return redirect()->route('reports.index');
        }

        // Если ошибка
        return back()->withErrors([
            'login' => 'Неверный логин или пароль',
        ])->withInput($request->only('login'));
    }

    // Выход из аккаунта
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
