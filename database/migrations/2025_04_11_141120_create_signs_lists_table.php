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
        Schema::create('signs_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Связь один-ко-многим
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('kind')->nullable()->default(''); // Характер работы
            $table->string('surname')->nullable()->default(''); // Фамилия
            $table->string('src')->nullable()->default(''); // Путь к изображению подписи
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signs_lists');
    }
};
