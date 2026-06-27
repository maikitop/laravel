@extends('layouts.app')

@section('content')
<!-- главная страница -->

<section>
    <h1 style="text-align: center; margin-bottom: 20px;"> Вы находитесь на сайте "Нарушениям.Нет"</h1>
    <p style="text-align: center; margin-bottom: 30px;"> Здесь можно сообщить об нарушениях</p>
</section>

<div class="slider-container"> <!-- слайдер -->
    <div class="slides">
        <div class="slide"><img src="{{ asset('images/slide1.png') }}" alt="пример нарушения1"></div>
        <div class="slide"><img src="{{ asset('images/slide2.png') }}" alt="пример нарушения2"></div>
        <div class="slide"><img src="{{ asset('images/slide3.png') }}" alt="пример нарушения3"></div>
    </div>

    <button class="slider-btn prev-btn"></button>
    <button class="slider-btn next-btn"></button>
</div>

@endsection