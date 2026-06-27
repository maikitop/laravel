<!-- resources/views/admin/index.blade.php -->
@extends('layouts.app')

@section('content')
<h2 style="margin-bottom: 20px;">Панель администратора (Все заявки)</h2>

<!-- Фильтрация по статусу -->
<div style="margin-bottom: 20px; background: #fff; padding: 15px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    <form method="GET" action="{{ route('admin.index') }}" style="display: flex; gap: 10px; align-items: flex-end;">
        <div class="form-group" style="margin-bottom: 0;">
            <label for="status_filter">Фильтр по статусу:</label>
            <select name="status" id="status_filter">
                <option value="">Все статусы</option>
                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Новые</option>
                <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Решённые</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Отклонённые</option>
            </select>
        </div>
        <button type="submit" class="btn">Применить</button>
    </form>
</div>

@php
$statusLabels = [
'new' => ['text' => 'Новое', 'class' => 'status-new'],
'resolved' => ['text' => 'Решено', 'class' => 'status-resolved'],
'rejected' => ['text' => 'Отклонено', 'class' => 'status-rejected'],
];
@endphp

@if($reports->isEmpty())
<p>Заявок не найдено.</p>
@else
<!-- Вывод списка всех заявок для администратора -->
@foreach($reports as $report)
<div class="report-card">
    <p><strong>ID заявки:</strong> {{ $report->id }}</p>
    <p><strong>ФИО заявителя:</strong> {{ $report->user->fio }}</p>

    <!-- Контактные данные зависят от выбора пользователя -->
    <p><strong>Связь ({{ $report->contact }}):</strong>
        {{ $report->contact == 'email' ? $report->user->email : $report->user->phone }}
    </p>

    <p><strong>Категория:</strong> {{ $report->category->name }}</p>
    <p><strong>Название:</strong> {{ $report->title }}</p>
    <p><strong>Описание:</strong> {{ Str::limit($report->description, 100) }}</p>

    <p style="margin: 10px 0;"><strong>Текущий статус:</strong>
        <span class="{{ $statusLabels[$report->status]['class'] }}">
            {{ $statusLabels[$report->status]['text'] }}
        </span>
    </p>

    <!-- Форма изменения статуса с классом для перехвата JS (модальное окно) -->
    <form method="POST" action="{{ route('admin.updateStatus', $report->id) }}" class="status-form" style="display: flex; gap: 10px; align-items: center;">
        @csrf
        <select name="status" required style="padding: 5px; border-radius: 4px;">
            <option value="new" {{ $report->status == 'new' ? 'selected' : '' }}>Новое</option>
            <option value="resolved" {{ $report->status == 'resolved' ? 'selected' : '' }}>Решено</option>
            <option value="rejected" {{ $report->status == 'rejected' ? 'selected' : '' }}>Отклонено</option>
        </select>
        <button type="submit" class="btn" style="padding: 5px 10px;">Сменить статус</button>
    </form>
</div>
@endforeach

<!-- Пагинация Laravel -->
<div class="pagination">
    {{ $reports->links() }}
</div>
@endif

<!-- Скрытое модальное окно подтверждения смены статуса (вызывается из JS) -->
<div id="confirm-modal" class="modal">
    <div class="modal-content">
        <h3 style="margin-bottom: 15px;">Подтверждение</h3>
        <p style="margin-bottom: 20px;">Вы уверены, что хотите изменить статус этой заявки?</p>
        <div style="display: flex; gap: 10px; justify-content: center;">
            <button id="confirm-btn" class="btn" style="background-color: var(--success);">Да, изменить</button>
            <button id="cancel-btn" class="btn" style="background-color: var(--danger);">Отмена</button>
        </div>
    </div>
</div>
@endsection