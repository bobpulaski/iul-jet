<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('signatures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Связь один-ко-многим
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Основная информация
            $table->string('kind')->nullable(); // Характер работы
            $table->string('surname')->nullable(); // Фамилия
            $table->date('signdate')->nullable(); // Дата подписания
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signatures');
    }
};
