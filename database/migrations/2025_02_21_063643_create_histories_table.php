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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Связь один-ко-многим
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Основная информация
            $table->string('name'); // Наименование объекта*
            $table->tinyInteger('order_number'); // № п/п*
            $table->string('document_designation'); // Обозначение документа*
            $table->string('document_name'); // Наименование документа*
            $table->tinyInteger('version_number'); // № версии*
            $table->string('current_algorithm'); // Алгоритм расчета контрольной суммы

            // Подвал
            $table->string('description')->nullable(); // Обозначение
            $table->tinyInteger('page')->nullable(); // Лист
            $table->tinyInteger('pages')->nullable(); // Листов
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
