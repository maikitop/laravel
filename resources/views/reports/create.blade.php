<!-- resources/views/reports/create.blade.php -->
@extends('layouts.app')

@section('content')
<!-- Форма создания заявления -->
<div class="form-container">
    <h2 style="margin-bottom: 20px;">Создать заявление</h2>

    <form method="POST" action="{{ route('reports.create') }}">
        @csrf

        <div class="form-group">
            <label for="title">Название проблемы:</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required placeholder="Коротко опишите суть">
            @error('title') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="category_id">Категория:</label>
            <!-- Выпадающий список категорий из базы -->
            <select id="category_id" name="category_id" required>
                <option value="" disabled selected>Выберите категорию...</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
            @error('category_id') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="description">Описание проблемы:</label>
            <textarea id="description" name="description" rows="5" required placeholder="Подробно опишите проблему">{{ old('description') }}</textarea>
            @error('description') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="date_incident">Дата нарушения (ДД.ММ.ГГГГ):</label>
            <!-- По умолчанию текущая дата -->
            <input type="text" id="date_incident" name="date_incident" value="{{ old('date_incident', date('d.m.Y')) }}" required placeholder="Например: 25.10.2023">
            @error('date_incident') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="contact">Способ обратной связи:</label>
            <select id="contact" name="contact" required>
                <option value="" disabled selected>Как с вами связаться?</option>
                <option value="email" {{ old('contact') == 'email' ? 'selected' : '' }}>Email</option>
                <option value="sms" {{ old('contact') == 'sms' ? 'selected' : '' }}>SMS на телефон</option>
            </select>
            @error('contact') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn">Отправить</button>
    </form>
</div>
@endsection