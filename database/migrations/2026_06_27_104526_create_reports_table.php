<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); //user_id
            $table->foreignId('category_id')->constrained()->cascadeOnDelete(); //category_id
            $table->string('title'); //название ошибки
            $table->text('description'); //описание
            $table->enum('category', ['Ямы на дорогах', 'Неисправное освещение', 'Мусор и свалки', 'Повреждение тротуара
', 'Сломанная детская площадка', 'Незаконная парковка', 'Повреждение дорожных знаков', 'Открытые люки и опасные участки']);
            $table->enum('status', ['new', 'resolved', 'rejected'])->default('new'); //статус решения ошибки
            $table->string('date_incident'); //дата происштествия
            $table->enum('contact', ['email', 'sms']);
            $table->$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
