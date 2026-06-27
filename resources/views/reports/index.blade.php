<!-- resources/views/reports/index.blade.php -->
@extends('layouts.app')

@section('content')
<h2 style="margin-bottom: 20px;">Мои заявки</h2>

<!-- Подготовка переводов статусов для вывода на русском языке и с цветом -->
@php
$statusLabels = [
'new' => ['text' => 'Новое', 'class' => 'status-new'],
'resolved' => ['text' => 'Решено', 'class' => 'status-resolved'],
'rejected' => ['text' => 'Отклонено', 'class' => 'status-rejected'],
];
@endphp

@if($reports->isEmpty())
<p>У вас пока нет поданных заявлений.</p>
@else
<!-- Вывод списка заявок пользователя -->
@foreach($reports as $report)
<div class="report-card">
    <h3>{{ $report->title }}</h3>
    <p><strong>Дата нарушения:</strong> {{ $report->date_incident }}</p>
    <p><strong>Категория:</strong> {{ $report->category->name }}</p>
    <p><strong>Статус:</strong>
        <span class="{{ $statusLabels[$report->status]['class'] }}">
            {{ $statusLabels[$report->status]['text'] }}
        </span>
    </p>

    <!-- Отзыв (показываем только если статус Решено) -->
    @if($report->status === 'resolved')
    <hr style="margin: 15px 0;">
    @if($report->feedback)
    <p><strong>Ваш отзыв:</strong> {{ $report->feedback }}</p>
    @else
    <form method="POST" action="{{ route('reports.feedback', $report->id) }}" style="margin-top: 10px;">
        @csrf
        <div class="form-group">
            <label for="feedback_{{ $report->id }}">Оставить отзыв о качестве работ:</label>
            <textarea id="feedback_{{ $report->id }}" name="feedback" rows="2" required placeholder="Напишите ваш отзыв..."></textarea>
        </div>
        <button type="submit" class="btn">Отправить отзыв</button>
    </form>
    @endif
    @endif
</div>
@endforeach
@endif
@endsection